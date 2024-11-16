<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{id}', [UrlController::class, 'visit'])->name('url.visit');

// Auth::routes();

Route::group(['prefix' => 'admin'], function () {

    Auth::routes();

});

Route::middleware('auth')->group(function () {
    Route::resource('/admin/urls', UrlController::class)->names([
        'store' => 'urls.store',
        'index' => 'urls.list',
        'update' => 'urls.update'
    ]);
    Route::resource('/admin/users', UserController::class)->names([
        'store' => 'users.store',
        'index' => 'users.list',
        'update' => 'users.update'
    ]);
    // Route::get('/url', [UrlController::class, 'index'])->name('url.list');
    // Route::get('/url/create', [UrlController::class, 'create'])->name('url.create');
    // Route::post('/url', [UrlController::class, 'store'])->name('url.store');
    // Route::put('/url', [UrlController::class, 'update'])->name('url.update');
    // Route::delete('/url', [UrlController::class, 'destroy'])->name('url.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
