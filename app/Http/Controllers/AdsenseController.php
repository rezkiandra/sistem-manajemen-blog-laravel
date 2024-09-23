<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Adsense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class AdsenseController extends Controller
{
	public function index()
	{
		return view('adsense.index');
	}

	public function create()
	{
		return view('adsense.create');
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

	public function store(Request $request)
	{
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url',
				'email'	=> 'required|email',
				'password' => 'required|password',
				'status' => 'required'
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			} else {
				$adsense = new Adsense();
				$adsense->domain = $request->domain;
				$adsense->email = $request->email;
				$adsense->password = $request->password;
				$adsense->status = $request->status;
				$adsense->save();
				return redirect()->route('adsense.index')->with('success', 'Adsense created successfully');
			}
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}

	public function edit(string $ads_id)
	{
		try {
			$adsense = Adsense::where('ads_id', $ads_id)->firstOrFail();
			return view('adsense.edit', compact('adsense'));
		} catch (Throwable $e) {
			abort(404);
		}
	}

	public function update(Request $request, string $ads_id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url',
				'email'	=> 'required|email',
				'password' => 'required|password',
				'status' => 'required'
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			} else {
				$adsense = Adsense::where('ads_id', $ads_id)->firstOrFail();
				$adsense->domain = $request->domain;
				$adsense->email = $request->email;
				$adsense->password = $request->password;
				$adsense->status = $request->status;
				$adsense->update();
				return redirect()->route('adsense.index')->with('success', 'Adsense updated successfully');
			}
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}

	public function destroy(string $ads_id)
	{
		try {
			$adsense = Adsense::where('ads_id', $ads_id)->firstOrFail();
			$adsense->delete();
			return redirect()->route('adsense.index')->with('success', 'Adsense deleted successfully');
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage())->withInput();
		}
	}
}
