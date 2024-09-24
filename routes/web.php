<?php

use App\Http\Controllers\AdsenseController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\VpsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/adsense', 301);

Route::middleware(['web'])->group(function () {
	Route::controller(DashboardController::class)->prefix('admin')->group(function () {
		Route::get('/', 'index')->name('dashboard');
	});
});

Route::middleware(['web'])->group(function () {
	Route::prefix('admin/blog')->group(function () {
		Route::resource('blog', BlogController::class);
	});

	Route::prefix('admin/adsense')->group(function () {
		Route::resource('adsense', AdsenseController::class);
	});

	Route::prefix('admin/domain')->group(function () {
		Route::resource('domain', DomainController::class);
	});

	Route::prefix('admin/vps')->group(function () {
		Route::resource('vps', VpsController::class);
	});

	Route::prefix('admin/provider')->group(function () {
		Route::resource('provider', ProviderController::class);
	});

	Route::prefix('admin/topic')->group(function () {
		Route::resource('topic', TopicController::class);
	});
});
