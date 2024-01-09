<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/v1/add_users', [\App\Http\Controllers\ApiController::class, 'store'])->middleware('cors');
Route::delete('/v1/delete_users', [\App\Http\Controllers\ApiController::class, 'destroy'])->middleware('cors');
