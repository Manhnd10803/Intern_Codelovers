<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartPhonesController;

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

Route::get('/', [SmartPhonesController::class, 'index']);
Route::resource('/product', SmartPhonesController::class);
Route::get('/search/product', [SmartPhonesController::class, 'search']);