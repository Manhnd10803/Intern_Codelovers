<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartPhonesController;
use App\Http\Controllers\AuthController;

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
// Đăng nhập
Route::get('/dang-nhap', [AuthController::class, 'getFormLogin'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'submitFormLogin'])->name('sign-in');
Route::get('/dang-ky', [AuthController::class, 'getFormRegister'])->name('sign-up');
Route::post('/dang-ky', [AuthController::class, 'submitFormRegister'])->name('sign-up');
Route::post('/dang-xuat', [AuthController::class, 'submitLogout'])->name('log-out');

Route::get('/quen-mat-khau', [AuthController::class, 'getFormForgotPass'])->name('forgot-pass');
Route::post('/quen-mat-khau', [AuthController::class, 'submitFormForgotPass'])->name('forgot-pass');
Route::get('/mat-khau-moi/{id}/{token}', [AuthController::class, 'getFormNewPass'])->name('mat-khau-moi');
Route::post('/dat-lai-mat-khau', [AuthController::class, 'submitFormNewPass'])->name('post-mat-khau-moi');

Route::get('/test-mail', [AuthController::class, 'testMail']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::resource('/product', SmartPhonesController::class);
});
Route::get('/search/product', [SmartPhonesController::class, 'search']);