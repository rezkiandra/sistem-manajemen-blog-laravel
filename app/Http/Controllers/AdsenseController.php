<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Adsense;
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
		$optionStatus = Adsense::getOptionStatus();
		return view('adsense.create', compact('optionStatus'));
	}

	public function store(Request $request)
	{
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url',
				'email'	=> 'required|email',
				'password' => 'required',
				'status' => 'required|in:PIN PO,PIN,Fresh,Kosong'
			], [
				'required'	=> ':attribute harus diisi',
				'domain.url' => 'Domain tidak valid',
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
			$adsense->password = Hash::make($request->password);
			$adsense->status = $request->status;
			$adsense->save();
			return redirect()->route('adsense.index')->with('success', 'Data adsense berhasil ditambahkan');
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}

	public function show(string $ads_id)
	{
		try {
			$adsense = Adsense::where('ads_id', $ads_id)->firstOrFail();
			return view('adsense.show', compact('adsense'));
		} catch (Throwable $e) {
			abort(404);
		}
	}

	public function edit(string $ads_id)
	{
		try {
			$optionStatus = Adsense::getOptionStatus();
			$adsense = Adsense::where('ads_id', $ads_id)->firstOrFail();
			return view('adsense.edit', compact('adsense', 'optionStatus'));
		} catch (Throwable $e) {
			abort(404);
		}
	}

	public function update(Request $request, string $ads_id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url',
				'email' => 'required|email',
				'status' => 'required|in:PIN PO,PIN,Fresh,Kosong'
			], [
				'required' => ':attribute harus diisi',
				'domain.url' => 'Domain tidak valid',
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

			$adsense = Adsense::where('ads_id', $ads_id)->firstOrFail();
			$adsense->domain = $request->domain;
			$adsense->email = $request->email;
			$adsense->status = $request->status;

			if ($request->new_password) {
				$adsense->password = Hash::make($request->new_password);
			}

			$adsense->update();

			return redirect()->route('adsense.index')->with('success', 'Data adsense berhasil diupdate');
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}

	public function destroy(string $ads_id)
	{
		try {
			$adsense = Adsense::where('ads_id', $ads_id)->firstOrFail();
			$adsense->delete();
			return redirect()->route('adsense.index')->with('success', 'Data adsense berhasil dihapus');
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}
}
