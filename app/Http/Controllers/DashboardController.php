<?php

namespace App\Http\Controllers;

use App\Models\Vps;
use App\Models\Blog;
use App\Models\Topic;
use App\Models\Domain;
use App\Models\Adsense;
use App\Models\Keyword;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogKeyword;

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
}
