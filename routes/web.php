<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (): Illuminate\View\View {
    return view('chanks.index');
})->name('chanks.index');

Route::post('urls', [App\Http\Controllers\UrlController::class, 'store'])->name('urls.store');

Route::get('urls', [App\Http\Controllers\UrlController::class, 'show'])->name('urls.show');

Route::get('urls/{id}', [App\Http\Controllers\UrlController::class, 'site'])->name('urls.site');

Route::post('urls/{id}/checks', [App\Http\Controllers\UrlCheckController::class, 'index'])->name('urls.check');
