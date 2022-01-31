<?php

use App\Http\Controllers\DivisionController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    

Route::prefix('divisions')->group(function () {
    Route::get('', [DivisionController::class, 'list']);
    Route::get('subdivisions/{id}', [DivisionController::class, 'subdivisions']);
    Route::get('view/{id}', [DivisionController::class, 'view']);
    Route::post('store', [DivisionController::class, 'store']);
    Route::put('update/{id}', [DivisionController::class, 'update']);
    Route::delete('delete/{id}', [DivisionController::class, 'delete']);
});
