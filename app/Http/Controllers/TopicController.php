<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
	public function index()
	{
		$topics = Topic::all();
		return view('topic.index', compact('topics'));
	}

	public function create()
	{
		return view('topic.create');
	}

	public function store(Request $request)
	{
		try {
			$validated = Validator::make($request->all(), [
				'name' => 'required|string|min:4|max:100|unique:topics,name',
			], [
				'required' => ':attribute harus diisi',
				'string' => ':attribute harus string',
				'min' => ':attribute minimal :min karakter',
				'max' => ':attribute maksimal :max karakter',
				'unique' => ':attribute sudah ada',
			], [
				'name' => 'Topik',
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$topic = new Topic();
			$topic->name = $request->name;
			$topic->save();
			return redirect()->route('topic.index')->with('success', 'Topik ' . $topic->name . ' berhasil ditambahkan');
		} catch (Exception $e) {
			return back()->withErrors($validated)->withInput();
		}
	}

	public function show(string $id)
	{
		try {
			$topic = Topic::findOrFail($id);
			return view('topic.show', compact('topic'));
		} catch (Exception $e) {
			return back()->withErrors($e->getMessage());
		}
	}

	public function edit(string $id)
	{
		try {
			$topic = Topic::findOrFail($id);
			return view('topic.edit', compact('topic'));
		} catch (Exception $e) {
			return back()->withErrors($e->getMessage());
		}
	}

	public function update(Request $request, string $id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'name' => 'required|string|min:4|max:100|unique:topics,name,' . $id,
			], [
				'required' => ':attribute harus diisi',
				'string' => ':attribute harus string',
				'min' => ':attribute minimal :min karakter',
				'max' => ':attribute maksimal :max karakter',
				'unique' => ':attribute sudah ada',
			], [
				'name' => 'Topic',
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$topic = Topic::findOrFail($id);
			$topic->name = $request->name;
			$topic->update();
			return redirect()->route('topic.index')->with('success', 'Topik ' . $topic->name . ' berhasil diupdate');
		} catch (Exception $e) {
			return back()->withErrors($validated)->withInput();
		}
	}

	public function destroy(string $id)
	{
		try {
			$topic = Topic::findOrFail($id);
			$topic->delete();
			return redirect()->route('topic.index')->with('success', 'Topik ' . $topic->name . ' berhasil dihapus');
		} catch (Exception $e) {
			return back()->withErrors($e->getMessage());
		}
	}
}
