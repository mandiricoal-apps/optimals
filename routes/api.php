<?php

use App\Http\Controllers\Api\AuthApi;
use App\Http\Controllers\Api\InspectionApi;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Artisan;
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

Route::post('/login', [AuthApi::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/simbolik', function () {
        return Artisan::call('storage:link');
    });
    Route::get('/logout', [AuthApi::class, 'logout']);

    Route::get('/sync', [InspectionApi::class, 'sync']);
    // Route::get('/sync', 'App\Http\Controllers\api\inspectionApi@sync');

    Route::prefix('inspection')->group(function () {
        Route::post('/create', [InspectionApi::class, 'create']);
    });
    Route::post('/upload-image', [InspectionApi::class, 'uploadImage']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
