<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Vps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
		$providerOptions = Vps::getProviderOption();
		return view('vps.create', compact('providerOptions'));
	}

	public function store(Request $request)
	{
		try {
			$validated = Validator::make($request->all(), [
				'provider' => 'required',
				'email' => 'required|email',
				'password' => 'required',
				'ip' => 'required|ip',
				'cpu' => 'required|integer',
				'ram' => 'required|integer',
			], [
				'required' => ':attribute harus diisi',
				'email' => ':attribute harus valid email',
				'integer' => ':attribute harus angka',
				'ip' => ':attribute harus valid ip',
			], [
				'provider' => 'Provider',
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
			$vps->provider = $request->provider;
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

	public function show(string $vps_id)
	{
		try {
			$vps = Vps::where('vps_id', $vps_id)->firstOrFail();
			return view('vps.show', compact('vps'));
		} catch (Throwable $e) {
			abort(404);
		}
	}

	public function edit(string $vps_id)
	{
		try {
			$providerOptions = Vps::getProviderOption();
			$vps = Vps::where('vps_id', $vps_id)->firstOrFail();
			return view('vps.edit', compact('vps', 'providerOptions'));
		} catch (Throwable $e) {
			abort(404);
		}
	}

	public function update(Request $request, string $vps_id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'provider' => 'required',
				'email' => 'required|email',
				'ip' => 'required|ip',
				'cpu' => 'required|integer|min:1|max:20',
				'ram' => 'required|integer|min:1|max:50',
			], [
				'required' => ':attribute harus diisi',
				'email' => ':attribute harus valid email',
				'integer' => ':attribute harus angka',
				'ip' => ':attribute harus valid ip',
				'min' => ':attribute minimal :min',
				'max' => ':attribute maksimal :max',
			], [
				'provider' => 'Provider',
				'email' => 'Email',
				'password' => 'Password',
				'ip' => 'IP Address',
				'cpu' => 'CPU',
				'ram' => 'RAM',
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$vps = Vps::where('vps_id', $vps_id)->firstOrFail();
			$vps->provider = $request->provider;
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

	public function destroy(string $vps_id)
	{
		try {
			$vps = Vps::where('vps_id', $vps_id)->firstOrFail();
			$vps->delete();
			return redirect()->route('vps.index')->with('success', 'Data VPS berhasil dihapus');
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}
}
