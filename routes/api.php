<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/admin', [AdminController::class, 'register']);
Route::post('/admin/login', [AdminController::class, 'login']);

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'get']);
    Route::get('/division', [DivisionController::class, 'get']);
    Route::post('/employee', [EmployeeController::class, 'create']);
    Route::get('/employee', [EmployeeController::class, 'get']);
    Route::put('/employee/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employee/{id}', [EmployeeController::class, 'delete']);
    Route::delete('/admin/logout', [AdminController::class, 'logout']);
});
