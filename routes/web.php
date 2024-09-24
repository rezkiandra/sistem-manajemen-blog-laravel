<?php

use App\Http\Controllers\AdsenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\VpsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/adsense', 301);

Route::middleware(['web'])->group(function () {
	Route::controller(DashboardController::class)->prefix('admin')->group(function () {
		Route::get('/', 'index')->name('dashboard');
	});
});

Route::middleware(['web'])->group(function () {
	Route::controller(AdsenseController::class)->prefix('admin/adsense')->group(function () {
		Route::get('/', 'index')->name('adsense.index');
		Route::get('/create', 'create')->name('adsense.create');
		Route::post('/store', 'store')->name('adsense.store');
		Route::get('/show/{adsense}', 'show')->name('adsense.show');
		Route::get('/edit/{adsense}', 'edit')->name('adsense.edit');
		Route::put('/update/{adsense}', 'update')->name('adsense.update');
		Route::delete('/destroy/{adsense}', 'destroy')->name('adsense.destroy');
	});

	Route::controller(DomainController::class)->prefix('admin/domain')->group(function () {
		Route::get('/', 'index')->name('domain.index');
		Route::get('/create', 'create')->name('domain.create');
		Route::post('/store', 'store')->name('domain.store');
		Route::get('/show/{domain}', 'show')->name('domain.show');
		Route::get('/edit/{domain}', 'edit')->name('domain.edit');
		Route::put('/update/{domain}', 'update')->name('domain.update');
		Route::delete('/destroy/{domain}', 'destroy')->name('domain.destroy');
	});

	Route::controller(VpsController::class)->prefix('admin/vps')->group(function () {
		Route::get('/', 'index')->name('vps.index');
		Route::get('/create', 'create')->name('vps.create');
		Route::post('/store', 'store')->name('vps.store');
		Route::get('/show/{vps}', 'show')->name('vps.show');
		Route::get('/edit/{vps}', 'edit')->name('vps.edit');
		Route::put('/update/{vps}', 'update')->name('vps.update');
		Route::delete('/destroy/{vps}', 'destroy')->name('vps.destroy');
	});
});
