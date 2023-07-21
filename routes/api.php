<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\AmenityController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ViewController;
use App\Http\Controllers\Api\SponsorController;

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

Route::get('/apartments',[ApartmentController::class, 'index']);
Route::get('/apartments/{slug}',[ApartmentController::class, 'show']);
Route::get('/amenities',[AmenityController::class, 'index']);
Route::get('/messages',[MessageController::class, 'index']);
Route::get('/views',[ViewController::class, 'index']);
Route::get('/sponsors',[SponsorController::class, 'index']);
