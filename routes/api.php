<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiPackageController;


Route::controller(AuthController::class)->group(function(){
  Route::post('/apilogin','login');
  Route::post('/apiregister', 'register');
  Route::post('/emailverify/otp/check', 'emailVerifyOtp');
  Route::post('/emailverify/otp/resend', 'emailVerifyOtpResend')->name('resend.email.otp');
});



Route::middleware(['auth:api','verified'])->group(function(){

   Route::controller(AuthController::class)->group(function(){
    Route::post('apilogout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me/{id}', 'me');
    Route::post('update/profile/{id}', 'updateProfile');
   });

   Route::controller(ApiOrderController::class)->group(function(){
    Route::post('apply/visa', 'store');
    Route::get('apply/visa/show', 'index');
    Route::get('apply/visa/{id}', 'show');
    Route::put('apply/visa/{id}', 'update');
    Route::delete('apply/visa/{id}', 'destroy');
    Route::get('apply/visa/order/user/{id}','userAPPlyVisa');
   });

   Route::controller(ApiPackageController::class)->group(function(){
    Route::get('package/visa', 'all');
    Route::get('package/visa/{id}', 'show');
   });
});
