<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OtpVerificationPromptController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/stuck', function () {
    return view('errors.permission-denied');
});
Route::get('email-test', function(){

    $details['email'] = 'sm.anuj.chauhan@gmail.com';
    dispatch(new App\Jobs\SendEmailJob($details));
    dd('done');
});

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth','otpverified','RoutePermissionChecker'])->name('dashboard');
Route::get('/verify-otp', [OtpVerificationPromptController::class, 'show'])->middleware(['auth']);
Route::post('/verify-otp',[OtpVerificationPromptController::class, 'verify'])->middleware(['auth'])->name('verify-otp');
Route::get('/cancel-otp-verification', [OtpVerificationPromptController::class, 'cancel'])->middleware(['auth']);

Route::get('/users', [UserController::class,'index'])->middleware(['auth','otpverified','RoutePermissionChecker'])->name('users');
Route::get('/users/edit/{id}',[UserController::class,'edit'])->middleware(['auth','otpverified','RoutePermissionChecker'])->whereNumber('id');
Route::get('/users/view/{id}',[UserController::class,'view'])->middleware(['auth','otpverified','RoutePermissionChecker'])->whereNumber('id');
Route::post('/users/edit',[UserController::class,'update'])->middleware(['auth','otpverified','RoutePermissionChecker'])->whereNumber('id');
Route::get('/users/add',[UserController::class,'add'])->middleware(['auth','otpverified','RoutePermissionChecker']);
Route::post('/users/store',[UserController::class,'store'])->middleware(['auth','otpverified','RoutePermissionChecker']);
Route::get('/users/delete/{id}',[UserController::class,'delete'])->middleware(['auth','otpverified','RoutePermissionChecker']);
Route::get('/users/export-users',[UserController::class,'exportUsers'])->middleware(['auth','otpverified','RoutePermissionChecker']);

Route::get('/categories', [CategoryController::class,'index'])->middleware(['auth','otpverified','RoutePermissionChecker'])->name('categories');
Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->middleware(['auth','otpverified','RoutePermissionChecker'])->whereNumber('id');
Route::get('/categories/view/{id}',[CategoryController::class,'view'])->middleware(['auth','otpverified','RoutePermissionChecker'])->whereNumber('id');

Route::post('/categories/edit',[CategoryController::class,'update'])->middleware(['auth','otpverified','RoutePermissionChecker'])->whereNumber('id');
Route::get('/categories/add',[CategoryController::class,'add'])->middleware(['auth','otpverified','RoutePermissionChecker']);
Route::post('/categories/store',[CategoryController::class,'store'])->middleware(['auth','otpverified','RoutePermissionChecker']);
Route::get('/categories/delete/{id}',[CategoryController::class,'delete'])->middleware(['auth','otpverified','RoutePermissionChecker']);



Route::get('/products', [ProductController::class,'index'])->middleware(['auth','otpverified','RoutePermissionChecker'])->name('products');
Route::get('/products/edit/{id}',[ProductController::class,'edit'])->middleware(['auth','otpverified','RoutePermissionChecker'])->whereNumber('id');
Route::post('/products/edit',[ProductController::class,'update'])->middleware(['auth','otpverified','RoutePermissionChecker'])->whereNumber('id');
Route::get('/products/add',[ProductController::class,'add'])->middleware(['auth','otpverified','RoutePermissionChecker']);
Route::post('/products/store',[ProductController::class,'store'])->middleware(['auth','otpverified','RoutePermissionChecker']);
Route::get('/products/delete/{id}',[ProductController::class,'delete'])->middleware(['auth','otpverified','RoutePermissionChecker']);


require __DIR__.'/auth.php';
