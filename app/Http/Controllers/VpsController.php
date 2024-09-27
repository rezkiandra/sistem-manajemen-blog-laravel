<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Vps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VpsController extends Controller
{
	public function index()
	{
		$vpss = Vps::all();
		return view('vps.index', compact('vpss'));
	}

	public function create()
	{
		$providers = Provider::get(['id', 'name']);
		return view('vps.create', compact('providers'));
	}

	public function store(Request $request)
	{
		try {
			$validated = Validator::make($request->all(), [
				'provider_id' => 'required|in:' . implode(',', Provider::pluck('id')->toArray()),
				'email' => 'required|email|unique:vps,email|max:100',
				'password' => 'required|max:100',
				'ip' => 'required|ip|unique:vps,ip|max:45',
				'cpu' => 'required|integer',
				'ram' => 'required|integer',
			], [
				'required' => ':attribute harus diisi',
				'email' => ':attribute harus valid email',
				'unique' => ':attribute sudah ada',
				'max' => ':attribute maksimal :max',
				'integer' => ':attribute harus angka',
				'ip' => ':attribute harus valid ip',
				'in' => ':attribute tidak valid',
			], [
				'provider_id' => 'Provider',
				'email' => 'Email',
				'password' => 'Password',
				'ip' => 'IP Address',
				'cpu' => 'CPU',
				'ram' => 'RAM',
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$vps = new Vps();
			$vps->provider_id = $request->provider_id;
			$vps->email = $request->email;
			$vps->password = Hash::make($request->password);
			$vps->ip = $request->ip;
			$vps->cpu = $request->cpu;
			$vps->ram = $request->ram;
			$vps->save();
			return redirect()->route('vps.index')->with('success', 'Data VPS berhasil ditambahkan');
		} catch (Throwable $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function show(string $id)
	{
		try {
			$vps = Vps::findOrFail($id);
			return view('vps.show', compact('vps'));
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage());
		}
	}

	public function edit(string $id)
	{
		try {
			$vps = Vps::findOrFail($id);
			$providers = Provider::get(['id', 'name']);
			return view('vps.edit', compact('vps', 'providers'));
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage());
		}
	}

	public function update(Request $request, string $id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'provider_id' => 'required|in:' . implode(',', Provider::pluck('id')->toArray()),
				'email' => 'required|email|max:100|unique:vps,email,' . $id,
				'ip' => 'required|ip|max:45|unique:vps,ip,' . $id,
				'cpu' => 'required|integer|min:1|max:20',
				'ram' => 'required|integer|min:1|max:50',
			], [
				'required' => ':attribute harus diisi',
				'email' => ':attribute harus valid email',
				'unique' => ':attribute sudah ada',
				'max' => ':attribute maksimal :max',
				'integer' => ':attribute harus angka',
				'ip' => ':attribute harus valid ip',
				'min' => ':attribute minimal :min',
				'max' => ':attribute maksimal :max',
				'in' => ':attribute tidak valid',
			], [
				'provider_id' => 'Provider',
				'email' => 'Email',
				'password' => 'Password',
				'ip' => 'IP Address',
				'cpu' => 'CPU',
				'ram' => 'RAM',
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$vps = Vps::findOrFail($id);
			$vps->provider_id = $request->provider_id;
			$vps->email = $request->email;
			$vps->ip = $request->ip;
			$vps->cpu = $request->cpu;
			$vps->ram = $request->ram;

			if ($request->new_password) {
				$vps->password = Hash::make($request->new_password);
			}

			$vps->update();
			return redirect()->route('vps.index')->with('success', 'Data VPS berhasil diupdate');
		} catch (Throwable $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function destroy(string $id)
	{
		try {
			$vps = Vps::findOrFail($id);
			$vps->delete();
			return redirect()->route('vps.index')->with('success', 'Data VPS berhasil dihapus');
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}
}
