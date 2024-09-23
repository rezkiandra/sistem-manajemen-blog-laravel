<?php

use App\Http\Controllers\AdsenseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});

Route::middleware(['auth'])->group(function () {
	Route::controller(AdsenseController::class)->prefix('admin/adsense')->group(function () {
		Route::get('/', 'index')->name('adsense.index');
		Route::get('/create', 'create')->name('adsense.create');
		Route::post('/store', 'store')->name('adsense.store');
		Route::get('/show/{adsense}', 'show')->name('adsense.show');
		Route::get('/edit/{adsense}', 'edit')->name('adsense.edit');
		Route::put('/update/{adsense}', 'update')->name('adsense.update');
		Route::delete('/destroy/{adsense}', 'destroy')->name('adsense.destroy');
	});
});
