<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\Api\AyatController;
use App\Http\Controllers\Api\SuratController;
use App\Http\Controllers\Api\TafsirController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});
Route::name('api.')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
    });

    // Route::middleware(['auth:api'])->group(function () {
        Route::prefix('auth')->name('auth.')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
        });

        Route::resource('surat', SuratController::class);
        Route::prefix('surat')->name('surat.')->group(function () {
            Route::get('detail', [SuratController::class, 'show'])->name('detail');
        });

        Route::resource('ayat', AyatController::class);
        Route::prefix('ayat')->name('ayat.')->group(function () {
            Route::get('detail', [AyatController::class, 'show'])->name('detail');
        });

        Route::resource('tafsir', TafsirController::class);
        Route::prefix('tafsir')->name('tafsir.')->group(function () {
            Route::get('detail', [TafsirController::class, 'show'])->name('detail');
        });
    // });

});
