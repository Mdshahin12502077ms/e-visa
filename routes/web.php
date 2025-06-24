<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfileControllers;
use App\Http\Controllers\Backend\UserController;
Route::get('/', function () {
    return view('welcome');
});







require __DIR__.'/auth.php';
require __DIR__.'/Backend.php';
