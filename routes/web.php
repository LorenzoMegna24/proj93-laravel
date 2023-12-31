<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\BraintreeController;
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

Route::middleware('auth')->group(function () {
    Route::get('/apartments', [ApartmentController::class, 'index'])->name('apartments.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/message/{id}', [MessageController::class, 'destroy'])->name('message.destroy');
    Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])->name('apartment.show');

    Route::resource('/profile/apartments', ApartmentController::class)->parameters([
        'apartments' => 'apartment:slug'
    ]);

    Route::any('/payment', [BraintreeController::class, 'token'])->name('token');
});

require __DIR__ . '/auth.php';
