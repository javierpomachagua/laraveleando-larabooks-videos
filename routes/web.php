<?php

use App\Http\Controllers\BookPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomePageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WelcomePageController::class);

Route::get('/books', BookPageController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('is.admin')->group(function () {
        Route::get('/only-admin', function () {
            return 'sólo el administrador puede ver esto';
        });
    });

    Route::middleware('is.reader')->group(function () {
        Route::get('/only-reader', function () {
            return 'sólo el lector puede ver esto';
        });
    });
});





require __DIR__.'/auth.php';
