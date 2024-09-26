<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Keyword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\UniqueKeywordArray;
use Illuminate\Support\Facades\Validator;

class KeywordController extends Controller
{
	public function index()
	{
		$keywords = Keyword::all();
		return view('keyword.index', compact('keywords'));
	}

	public function create()
	{
		$keywords = Keyword::all();
		return view('keyword.create', compact('keywords'));
	}

	public function store(Request $request)
	{
		try {
			$validated = Validator::make($request->all(), [
				'name' => 'required|string|min:1|unique:keywords,name',
			], [
				'required' => ':attribute harus diisi',
				'string' => ':attribute harus string',
				'min' => ':attribute minimal :min karakter',
				'unique' => ':attribute sudah ada',
			], [
				'name' => 'Keyword',
			]);

			if ($validated->fails()) {
				return redirect()->back()->withErrors($validated)->withInput();
			}

			$keyword = new Keyword();
			$keyword->name = $request->name;
			$keyword->slug = Str::slug($request->name);
			$keyword->save();

			return redirect()->route('keyword.index')->with('success', 'Data keyword berhasil ditambahkan');
		} catch (Throwable $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function show(string $id)
	{
		try {
			$keyword = Keyword::find($id);
			return view('keyword.show', compact('keyword'));
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage());
		}
	}

	public function edit(string $id)
	{
		try {
			$keyword = Keyword::find($id);
			return view('keyword.edit', compact('keyword'));
		} catch (Throwable $e) {
			return back()->withErrors($e->getMessage());
		}
	}

	public function update(Request $request, string $id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'name' => 'required|string|min:1|unique:keywords,name' . $id,
			], [
				'required' => ':attribute harus diisi',
				'string' => ':attribute harus string',
				'min' => ':attribute minimal :min karakter',
				'unique' => ':attribute sudah ada',
			], [
				'name' => 'Keyword',
			]);

			if ($validated->fails()) {
				return redirect()->back()->withErrors($validated)->withInput();
			}

			$keyword = Keyword::findOrFail($id);
			$keyword->name = $request->name;
			$keyword->slug = Str::slug($request->name);
			$keyword->update();

			return redirect()->route('keyword.index')->with('success', 'Data keyword berhasil diupdate');
		} catch (Throwable $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function destroy(string $id)
	{
		try {
			$keyword = Keyword::find($id);
			$keyword->delete();
			return redirect()->back()->with('success', 'Data keyword berhasil dihapus');
		} catch (Throwable $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}
}
