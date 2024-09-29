<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Blog;
use App\Models\Keyword;
use App\Models\BlogKeyword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogKeywordController extends Controller
{
	public function index()
	{
		$blogKeywords = BlogKeyword::all();

		$blogKeywords->transform(function ($item) {
			$item->keyword = json_decode($item->keyword, true);
			return $item;
		});

		return view('blog-keyword.index', compact('blogKeywords'));
	}

	public function create()
	{
		$keywords = Keyword::all();
		$blogs = Blog::doesntHave('blogKeyword')->get();
		return view('blog-keyword.create', compact('blogs', 'keywords'));
	}

	public function store(Request $request)
	{
		try {
			$validated = Validator::make($request->all(), [
				'blog_id' => 'required|exists:blogs,id',
				'keyword' => 'required|array',
				'keyword.*' => 'required|array|exists:keywords,name',
			], [
				'required' => ':attribute harus diisi',
				'exists' => ':attribute tidak valid',
				'array' => ':attribute harus berupa array',
			], [
				'blog_id' => 'Domain',
				'keyword' => 'Keyword',
				'keyword.*' => 'Keyword',
			]);

			if ($validated->fails()) {
				return redirect()->back()->withErrors($validated)->withInput();
			}

			$blogKeyword = new BlogKeyword();
			$blogKeyword->blog_id = $request->blog_id;
			$blogKeyword->keyword = json_encode($request->keyword);
			$blogKeyword->save();

			return redirect()->route('blog-keyword.index')->with('success', 'Keyword berhasil ditambahkan ke blog ' . $blogKeyword->blog->domain);
		} catch (Exception $e) {
			return redirect()->back()->withInput()->with('error', $e->getMessage());
		}
	}

	public function show(string $id)
	{
		try {
			$blogKeyword = BlogKeyword::findOrFail($id);
			$blogKeyword->keyword = json_decode($blogKeyword->keyword, true);
			return view('blog-keyword.show', compact('blogKeyword'));
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function edit(string $id)
	{
		try {
			$blogs = Blog::all();
			$blogKeyword = BlogKeyword::findOrFail($id);
			$keywords = json_decode($blogKeyword->keyword, true);
			$allKeywords = Keyword::all()->pluck('name', 'id')->toArray();
			return view('blog-keyword.edit', compact('blogKeyword', 'blogs', 'keywords', 'allKeywords'));
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function update(Request $request, string $id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'blog_id' => 'required|exists:blogs,id',
				'keyword' => 'required|array',
				'keyword.*' => 'required|array|exists:keywords,name'
			], [
				'required' => ':attribute harus diisi',
				'exists' => ':attribute tidak valid',
				'array' => ':attribute harus berupa array',
			], [
				'blog_id' => 'Domain',
				'keyword' => 'Keyword',
				'keyword.*' => 'Keyword',
			]);

			if ($validated->fails()) {
				return redirect()->back()->withErrors($validated)->withInput();
			}

			$blogKeyword = BlogKeyword::findOrFail($id);
			$blogKeyword->blog_id = $request->blog_id;
			$blogKeyword->keyword = json_encode($request->keyword);
			$blogKeyword->update();

			return redirect()->route('blog-keyword.index')->with('success', 'Keyword berhasil diupdate pada blog ' . $blogKeyword->blog->domain);
		} catch (Exception $e) {
			return redirect()->back()->withInput()->with('error', $e->getMessage());
		}
	}

	public function destroy(string $id)
	{
		try {
			$blogKeyword = BlogKeyword::findOrFail($id);
			$blogKeyword->delete();
			return redirect()->route('blog-keyword.index')->with('success', 'Keyword dihapus dari blog ' . $blogKeyword->blog->domain);
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}
}
