<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/apilogin',[AuthController::class,'login']);

Route::middleware(['auth:api'])->group(function(){
    
   Route::controller(AuthController::class)->group(function(){
    Route::post('apilogout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('me', 'me');
   });

});