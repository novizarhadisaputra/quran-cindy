<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuratController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/surat', [SuratController::class, 'index'])->name('surat');

Route::get('/surat/{slug}', [SuratController::class, 'detail'])->name('surat.detail');
