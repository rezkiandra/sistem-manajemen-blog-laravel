<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Adsense;
use App\Models\Provider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdsenseController extends Controller
{
	public function index()
	{
		$adsenses = Adsense::all();
		return view('adsense.index', compact('adsenses'));
	}

	public function create()
	{
		$status = Adsense::getOptionStatus();
		return view('adsense.create', compact('status'));
	}

	public function store(Request $request)
	{
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url|unique:adsenses,domain|max:100',
				'email'	=> 'required|email|unique:adsenses,email|max:100',
				'password' => 'required',
				'status' => 'required|in:PIN PO,PIN,Fresh,Kosong'
			], [
				'required'	=> ':attribute harus diisi',
				'domain.url' => 'Domain tidak valid',
				'unique' => ':attribute sudah ada',
				'max' => ':attribute tidak boleh lebih dari :max karakter',
				'email.email' => 'Email tidak valid',
				'status.in' => 'Status tidak valid'
			], [
				'domain' => 'Domain',
				'email'	=> 'Email',
				'password' => 'Password',
				'status' => 'Status'
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$adsense = new Adsense();
			$adsense->domain = $request->domain;
			$adsense->email = $request->email;
			$adsense->password = $request->password;
			$adsense->status = $request->status;
			$adsense->save();
			return redirect()->route('adsense.index')->with('success', 'Data adsense berhasil ditambahkan');
		} catch (Exception $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}

	public function show(string $id)
	{
		try {
			$adsense = Adsense::findOrFail($id);
			return view('adsense.show', compact('adsense'));
		} catch (Exception $e) {
			return back()->withErrors($e->getMessage());
		}
	}

	public function edit(string $id)
	{
		try {
			$adsense = Adsense::findOrFail($id);
			$status = Adsense::getOptionStatus();
			$providers = Provider::get(['id', 'name']);
			return view('adsense.edit', compact('adsense', 'status', 'providers'));
		} catch (Exception $e) {
			return back()->withErrors($e->getMessage());
		}
	}

	public function update(Request $request, string $id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url|max:100|unique:adsenses,domain,' . $id,
				'email' => 'required|email|max:100|unique:adsenses,email,' . $id,
				'status' => 'required|in:PIN PO,PIN,Fresh,Kosong'
			], [
				'required' => ':attribute harus diisi',
				'domain.url' => 'Domain tidak valid',
				'unique' => ':attribute sudah ada',
				'max' => ':attribute tidak boleh lebih dari :max karakter',
				'email.email' => 'Email tidak valid',
				'status.in' => 'Status tidak valid'
			], [
				'domain' => 'Domain',
				'email' => 'Email',
				'status' => 'Status'
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$adsense = Adsense::findOrFail($id);
			$adsense->domain = $request->domain;
			$adsense->email = $request->email;
			$adsense->status = $request->status;

			if ($request->new_password) {
				$adsense->password = $request->new_password;
			}

			$adsense->update();

			return redirect()->route('adsense.index')->with('success', 'Data adsense berhasil diupdate');
		} catch (Exception $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}

	public function destroy(string $id)
	{
		try {
			$adsense = Adsense::findOrFail($id);
			$adsense->delete();
			return redirect()->route('adsense.index')->with('success', 'Data adsense berhasil dihapus');
		} catch (Exception $e) {
			return back()->withErrors($e->getMessage());
		}
	}
}
