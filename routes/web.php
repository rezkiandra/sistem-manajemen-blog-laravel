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
	Route::prefix('admin')->group(function () {
		Route::resource('blog', BlogController::class);
		Route::resource('adsense', AdsenseController::class);
		Route::resource('domain', DomainController::class);
		Route::resource('vps', VpsController::class);
		Route::resource('provider', ProviderController::class);
		Route::resource('topic', TopicController::class);
	});
});
