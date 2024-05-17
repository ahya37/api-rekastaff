<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Open Routes
// Route::post("register", [AuthController::class, "register"]); 
Route::post("login", [AuthController::class, "login"]);

// Protected Routes
Route::middleware(['api-token'])->group(function () {
    Route::get('/profile',[AuthController::class,'profile']);
    
    // Employee
    Route::prefix('employees')->controller(EmployeeController::class)->group(function(){
        Route::post('/create','create');
    });
});



// // Protected Routes
// Route::group([
//     "middleware" => ["auth:sanctum"]
// ], function(){

//     Route::get("profile", [AuthController::class, "profile"]);
//     Route::get("logout", [AuthController::class, "logout"]);
// });


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
