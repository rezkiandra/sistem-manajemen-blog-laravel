<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
	public function index()
	{
		$providers = Provider::all();
		return view('provider.index', compact('providers'));
	}

	public function create()
	{
		return view('provider.create');
	}

	public function store(Request $request)
	{
		try {
			$validated = Validator::make($request->all(), [
				'name' => 'required|string|min:4|max:100',
			], [
				'required' => ':attribute harus diisi',
				'string' => ':attribute harus string',
				'min' => ':attribute minimal :min karakter',
				'max' => ':attribute maksimal :max karakter',
			], [
				'name' => 'Provider',
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$provider = new Provider();
			$provider->name = $request->name;
			$provider->save();
			return redirect()->route('provider.index')->with('success', 'Provider ' . $provider->name . ' berhasil ditambahkan');
		} catch (Throwable $e) {
			return back()->withErrors($validated)->withInput();
		}
	}

	public function show(string $provider_id)
	{
		try {
			$provider = Provider::where('provider_id', $provider_id)->firstOrFail();
			return view('provider.show', compact('provider'));
		} catch (Throwable $e) {
			return abort(404);
		}
	}

	public function edit(string $provider_id)
	{
		try {
			$provider = Provider::where('provider_id', $provider_id)->firstOrFail();
			return view('provider.edit', compact('provider'));
		} catch (Throwable $e) {
			return abort(404);
		}
	}

	public function update(Request $request, string $provider_id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'name' => 'required|string|min:4|max:100',
			], [
				'required' => ':attribute harus diisi',
				'string' => ':attribute harus string',
				'min' => ':attribute minimal :min karakter',
				'max' => ':attribute maksimal :max karakter',
			], [
				'name' => 'Provider',
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$provider = Provider::where('provider_id', $provider_id)->firstOrFail();
			$provider->name = $request->name;
			$provider->update();
			return redirect()->route('provider.index')->with('success', 'Provider ' . $provider->name . ' berhasil diupdate');
		} catch (Throwable $e) {
			return back()->withErrors($validated)->withInput();
		}
	}

	public function destroy(string $provider_id)
	{
		try {
			$provider = Provider::where('provider_id', $provider_id)->firstOrFail();
			$provider->delete();
			return redirect()->route('provider.index')->with('success', 'Provider ' . $provider->name . ' berhasil dihapus');
		} catch (Throwable $e) {
			return abort(404);
		}
	}
}
