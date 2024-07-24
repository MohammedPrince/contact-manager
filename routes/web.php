<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

//Migration
Route::get('/migrate', function () {
    Artisan::call('migrate');
    //Artisan::call('migrate', ['--force' => true ]);
    dd('migrated!');
});


Route::get('/', [ContactController::class, 'index'])->name('home');
Route::post('/AddContact', [ContactController::class, 'AddContact'])->name('AddContact');
Route::get('/edit/{id}', [ContactController::class, 'EditContact'])->name('EditContact');
Route::post('/UpdateContact/{id}', [ContactController::class, 'UpdateContact'])->name('UpdateContact');
Route::get('/delete/{id}', [ContactController::class, 'deleteRecord']);

