<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Domain;
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
		$providerOptions = Domain::getProviderOption();
		return view('domain.create', compact('providerOptions'));
	}

	public function store(Request $request)
	{
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url',
				'provider' => 'required',
				'email' => 'required|email',
				'password' => 'required',
				'masa_aktif' => 'required|integer|min:1',
			], [
				'required' => ':attribute harus diisi',
				'email' => ':attribute harus valid',
				'url' => ':attribute harus valid',
				'integer' => ':attribute harus angka',
				'min' => ':attribute minimal harus :min',
			], [
				'domain' => 'Domain',
				'provider' => 'Provider',
				'email' => 'Email',
				'password' => 'Password',
				'masa_aktif' => 'Masa aktif',
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$domain = new Domain();
			$domain->domain = $request->domain;
			$domain->provider = $request->provider;
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

	public function show(string $domain_id)
	{
		try {
			$domain = Domain::where('domain_id', $domain_id)->firstOrFail();
			return view('domain.show', compact('domain'));
		} catch (Throwable $e) {
			abort(404);
		}
	}

	public function edit(string $domain_id)
	{
		try {
			$providerOptions = Domain::getProviderOption();
			$domain = Domain::where('domain_id', $domain_id)->firstOrFail();
			return view('domain.edit', compact('domain', 'providerOptions'));
		} catch (Throwable $e) {
			abort(404);
		}
	}

	public function update(Request $request, string $domain_id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url',
				'provider' => 'required',
				'email' => 'required|email',
				'masa_aktif' => 'required|integer|min:1',
			], [
				'required' => ':attribute harus diisi',
				'email' => ':attribute harus valid',
				'url' => ':attribute harus valid',
				'integer' => ':attribute harus angka',
				'min' => ':attribute minimal harus :min',
			], [
				'domain' => 'Domain',
				'provider' => 'Provider',
				'email' => 'Email',
				'password' => 'Password',
				'masa_aktif' => 'Masa Aktif'
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$domain = Domain::where('domain_id', $domain_id)->firstOrFail();
			$domain->domain = $request->domain;
			$domain->provider = $request->provider;
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

	public function destroy(string $domain_id)
	{
		try {
			$domain = Domain::where('domain_id', $domain_id)->firstOrFail();
			$domain->delete();
			return redirect()->route('domain.index')->with('success', 'Data domain berhasil dihapus');
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}
}
