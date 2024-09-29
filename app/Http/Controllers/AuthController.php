<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	public function login()
	{
		return view('auth.login');
	}

	public function authenticate(Request $request): RedirectResponse
	{
		$credentials = $request->validate([
			'email' => ['required', 'email'],
			'password' => ['required'],
		], [
			'email.required' => 'Email harus diisi',
			'password.required' => 'Password harus diisi',
		], [
			'email' => 'Email',
			'password' => 'Password',
		]);

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();
			return redirect()->route('dashboard')->with('success', 'Anda berhasil login ke aplikasi');
		}

		return back()->withErrors(['email' => 'Kredensial tidak valid'])->onlyInput('email');
	}

	public function logout()
	{
		Auth::logout();

		request()->session()->invalidate();
		request()->session()->regenerateToken();
		
		return redirect()->route('login')->with('success', 'Anda berhasil logout dari aplikasi');
	}
}
