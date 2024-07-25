<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactApiController;

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

Route::middleware(['JsonRes'])->group(function () {

    Route::get('/', [ContactApiController::class, 'GetConacts_API']);
    Route::post('/Add', [ContactApiController::class, 'AddContact_API']);
    Route::get('/GetContactById/{id}', [ContactApiController::class, 'GetContactById_API']);
    Route::post('/UpdateContact/{id}', [ContactApiController::class, 'UpdateContact_API']);
    Route::get('/DeleteRecord/{id}', [ContactApiController::class, 'DeleteRecord_API']);
    
});
