<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VenueController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\UserController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::resources([
    'venues' => VenueController::class,
    'venues.show' => VenueController::class,
    'attributes' => AttributeController::class
]);


Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    Route::get("", [UserController::class, 'index']);
    Route::get("/{id}", [UserController::class, 'show']);
});

Route::group(['prefix' => 'venues', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/{venue}/rating', [VenueController::class, 'get_rating']);
    Route::post('/{venue}/rate', [VenueController::class, 'rate']);
});

Route::get('attributes_search', [VenueController::class, 'attributes_search']);
Route::get('name_search', [VenueController::class, 'name_search']);
