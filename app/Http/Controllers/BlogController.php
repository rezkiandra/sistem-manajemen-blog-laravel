<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Blog;
use App\Models\Topic;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Throw_;

class BlogController extends Controller
{
	public function index()
	{
		return view('blog.index');
	}

	public function create()
	{
		$topics = Topic::get(['id', 'name']);
		$providers = Provider::get(['id', 'name']);
		return view('blog.create', compact('topic', 'providers'));
	}

	public function store(Request $request)
	{
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url|unique:blogs,domain',
				'ip' => 'required|ip|unique:blogs,ip',
				'provider_id' => 'required|in:' . implode(',', Provider::pluck('id')->toArray()),
				'topic_id' => 'required|in:' . implode(',', Topic::pluck('id')->toArray()),
				'traffic_views' => 'required|integer|min:1',
				'status' => 'required|in:PIN PO,PIN,Fresh,Kosong',
				'domain_authority' => 'required|integer|min:1',
				'domain_rating' => 'required|integer|min:1',
				'lang' => 'required|in:indonesia,inggris',
				'pic' => 'required|string',
			], [
				'required' => ':attribute harus diisi',
				'url' => ':attribute harus valid',
				'unique' => ':attribute sudah ada',
				'ip' => ':attribute harus valid',
				'integer' => ':attribute harus angka',
				'min' => ':attribute minimal :min',
				'in' => ':attribute tidak valid',
				'string' => ':attribute harus string',
			], [
				'domain' => 'Domain',
				'ip' => 'IP Address',
				'provider_id' => 'Provider',
				'topic_id' => 'Topic',
				'traffic_views' => 'Traffic',
				'status' => 'Status',
				'domain_authority' => 'Domain Authority',
				'domain_rating' => 'Domain Rating',
				'lang' => 'Language',
				'pic' => 'PIC',
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$blog = new Blog();
			$blog->domain = $request->domain;
			$blog->ip = $request->ip;
			$blog->provider_id = $request->provider_id;
			$blog->topic_id = $request->topic_id;
			$blog->traffic_views = $request->traffic;
			$blog->status = $request->status;
			$blog->domain_authority = $request->domain_authority;
			$blog->domain_rating = $request->domain_rating;
			$blog->lang = $request->lang;
			$blog->pic = $request->pic;
			$blog->save();
			return redirect()->route('blog.index')->with('success', 'Data blog berhasil ditambahkan');
		} catch (Throwable $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function show(string $id)
	{
		try {
			$blog = Blog::findOrFail($id);
			return view('blog.show', compact('blog'));
		} catch (Throwable $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function edit(string $id)
	{
		try {
			$blog = Blog::findOrFail($id);
			$topics = Topic::get(['id', 'name']);
			$providers = Provider::get(['id', 'name']);
			return view('blog.edit', compact('blog', 'topics', 'providers'));
		} catch (Throwable $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function update(Request $request, string $id)
	{
		try {
			$validated = Validator::make($request->all(), [
				'domain' => 'required|url|unique:blogs,domain,' . $id,
				'ip' => 'required|ip|unique:blogs,ip,' . $id,
				'provider_id' => 'required|in:' . implode(',', Provider::pluck('id')->toArray()),
				'topic_id' => 'required|in:' . implode(',', Topic::pluck('id')->toArray()),
				'traffic_views' => 'required|integer|min:1',
				'status' => 'required|in:PIN PO,PIN,Fresh,Kosong',
				'domain_authority' => 'required|integer|min:1',
				'domain_rating' => 'required|integer|min:1',
				'lang' => 'required|in:indonesia,inggris',
				'pic' => 'required|string',
			], [
				'required' => ':attribute harus diisi',
				'url' => ':attribute harus valid',
				'unique' => ':attribute sudah ada',
				'ip' => ':attribute harus valid',
				'integer' => ':attribute harus angka',
				'min' => ':attribute minimal :min',
				'in' => ':attribute tidak valid',
				'string' => ':attribute harus string',
			], [
				'domain' => 'Domain',
				'ip' => 'IP Address',
				'provider_id' => 'Provider',
				'topic_id' => 'Topic',
				'traffic_views' => 'Traffic',
				'status' => 'Status',
				'domain_authority' => 'Domain Authority',
				'domain_rating' => 'Domain Rating',
				'lang' => 'Language',
				'pic' => 'PIC',
			]);

			if ($validated->fails()) {
				return back()->withErrors($validated)->withInput();
			}

			$blog = Blog::findOrFail($id);
			$blog->domain = $request->domain;
			$blog->ip = $request->ip;
			$blog->provider_id = $request->provider_id;
			$blog->topic_id = $request->topic_id;
			$blog->traffic_views = $request->traffic;
			$blog->status = $request->status;
			$blog->domain_authority = $request->domain_authority;
			$blog->domain_rating = $request->domain_rating;
			$blog->lang = $request->lang;
			$blog->pic = $request->pic;
			$blog->update();
			return redirect()->route('blog.index')->with('success', 'Data blog berhasil diupdate');
		} catch (Throwable $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function destroy(string $id)
	{
		try {
			$blog = Blog::findOrFail($id);
			$blog->delete();
			return redirect()->route('blog.index')->with('success', 'Data blog berhasil dihapus');
		} catch (Throwable $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}
}
