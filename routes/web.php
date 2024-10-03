<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VpsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\AdsenseController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogKeywordController;

Route::redirect('/', '/admin/adsense', 301);

Route::controller(AuthController::class)->prefix('auth')->group(function () {
	Route::get('/login', 'login')->name('login');
	Route::post('/login', 'authenticate')->name('authenticate');
	Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::middleware(['auth'])->group(function () {
	Route::prefix('admin')->group(function () {
		Route::resource('blog', BlogController::class);
		Route::resource('blog-keyword', BlogKeywordController::class);
		Route::resource('keyword', KeywordController::class);
		Route::resource('adsense', AdsenseController::class);
		Route::resource('domain', DomainController::class);
		Route::resource('vps', VpsController::class);
		Route::resource('provider', ProviderController::class);
		Route::resource('topic', TopicController::class);

		Route::controller(DashboardController::class)->group(function () {
			Route::get('/', 'index')->name('dashboard');
			Route::get('/profile/{user}', 'profile')->name('dashboard.profile');
			Route::put('/profile/{user}', 'updateProfile')->name('dashboard.profile.update');
			Route::get('change-password/{user}', 'changePassword')->name('dashboard.change-password');
			Route::put('change-password/{user}', 'updatePassword')->name('dashboard.update-password');
		});
	});
});
