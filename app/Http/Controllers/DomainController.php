<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Domain;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DomainController extends Controller
{
	public function index()
	{
		$domains = Domain::all();
		return view('domain.index', compact('domains'));
	}

	public function create()
	{
		$providers = Provider::get(['id', 'name']);
		return view('domain.create', compact('providers'));
	}

	public function store(Request $request)
	{
		// dd($request->all());
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url',
				'provider_id' => 'required|in:' . implode(',', Provider::pluck('id')->toArray()),
				'email' => 'required|email',
				'password' => 'required',
				'masa_aktif' => 'required|integer|min:1',
			], [
				'required' => ':attribute harus diisi',
				'email' => ':attribute harus valid',
				'url' => ':attribute harus valid',
				'integer' => ':attribute harus angka',
				'min' => ':attribute minimal harus :min',
				'in' => ':attribute tidak valid',
			], [
				'domain' => 'Domain',
				'provider_id' => 'Provider',
				'email' => 'Email',
				'password' => 'Password',
				'masa_aktif' => 'Masa aktif',
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$domain = new Domain();
			$domain->domain = $request->domain;
			$domain->provider_id = $request->provider_id;
			$domain->email = $request->email;
			$domain->password = Hash::make($request->password);
			$domain->masa_aktif = $request->masa_aktif;
			$domain->expired_at = Carbon::now()->addDay((int)$request->masa_aktif);

			$domain->save();
			return redirect()->route('domain.index')->with('success', 'Data domain berhasil ditambahkan');
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}

	public function show(string $id)
	{
		try {
			$domain = Domain::findOrFail($id);
			return view('domain.show', compact('domain'));
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage());
		}
	}

	public function edit(string $id)
	{
		try {
			$providers = Provider::get(['id', 'name']);
			$domain = Domain::findOrFail($id);
			return view('domain.edit', compact('domain', 'providers'));
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage());
		}
	}

	public function update(Request $request, string $id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url',
				'provider_id' => 'required|in:' . implode(',', Provider::pluck('id')->toArray()),
				'email' => 'required|email',
				'masa_aktif' => 'required|integer|min:1',
			], [
				'required' => ':attribute harus diisi',
				'email' => ':attribute harus valid',
				'url' => ':attribute harus valid',
				'integer' => ':attribute harus angka',
				'min' => ':attribute minimal harus :min',
				'in' => ':attribute tidak valid',
			], [
				'domain' => 'Domain',
				'provider_id' => 'Provider',
				'email' => 'Email',
				'password' => 'Password',
				'masa_aktif' => 'Masa Aktif'
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$domain = Domain::findOrFail($id);
			$domain->domain = $request->domain;
			$domain->provider_id = $request->provider_id;
			$domain->email = $request->email;
			$domain->masa_aktif = $request->masa_aktif;
			$domain->expired_at = Carbon::now()->addDay((int)$request->masa_aktif);

			if ($request->new_password) {
				$domain->password = Hash::make($request->new_password);
			}

			$domain->update();
			return redirect()->route('domain.index')->with('success', 'Data domain berhasil diupdate');
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}

	public function destroy(string $id)
	{
		try {
			$domain = Domain::findOrFail($id);
			$domain->delete();
			return redirect()->route('domain.index')->with('success', 'Data domain berhasil dihapus');
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage());
		}
	}
}
