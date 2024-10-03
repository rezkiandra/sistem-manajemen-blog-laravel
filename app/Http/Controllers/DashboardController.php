<?php

namespace App\Http\Controllers;

use App\Models\Vps;
use App\Models\Blog;
use App\Models\User;
use App\Models\Topic;
use App\Models\Domain;
use App\Models\Adsense;
use App\Models\Keyword;
use App\Models\Provider;
use App\Models\BlogKeyword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
	public function index()
	{
		$data = [
			'blogs' => Blog::count(),
			'adsenses' => Adsense::count(),
			'domains' => Domain::count(),
			'vpses' => Vps::count(),
			'providers' => Provider::count(),
			'topics' => Topic::count(),
			'keywords' => Keyword::count(),
			'blogsWithKeywords' => BlogKeyword::count(),
		];

		return view('admin.dashboard', compact('data'));
	}

	public function profile(User $user)
	{
		$user = auth()->user();
		return view('admin.profile', compact('user'));
	}

	public function updateProfile(Request $request, User $user)
	{
		$request->validate([
			'name' => 'required_if:email,' . auth()->user()->email . '|max:100',
			'email' => 'required_if:name,' . auth()->user()->name . '|email|max:100',
		], [
			'required_if' => ':attribute harus diisi',
		], [
			'name' => 'Name',
			'email' => 'Email',
		]);

		$user->update([
			'name' => $request->name,
			'email' => $request->email,
		]);

		return back()->with('success', 'Profil Admin berhasil diupdate');
	}

	public function changePassword(User $user)
	{
		$user = auth()->user();
		return view('admin.change-password', compact('user'));
	}

	public function updatePassword(Request $request, User $user)
	{
		$request->validate(
			[
				'old_password' => 'required|current_password',
				'new_password' => 'required|min:6|confirmed',
			],
			[
				'required' => ':attribute harus diisi',
				'min' => ':attribute minimal :min karakter',
				'confirmed' => 'Konfirmasi :attribute tidak cocok',
			],
			[
				'old_password' => 'Password Lama',
				'new_password' => 'Password Baru',
				'new_password_confirmation' => 'Konfirmasi Password',
			]
		);

		$user->update([
			'password' => Hash::make($request->new_password),
		]);

		return back()->with('success', 'Password Admin berhasil diupdate');
	}
}
