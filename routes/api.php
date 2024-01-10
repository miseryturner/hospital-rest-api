<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\RecordController;

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

Route::post('/register', [AuthController::class, 'regiter']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/patient', [AuthController::class, 'patient'])->middleware('user_token');

Route::get('/doctor', [DoctorController::class, 'index']);
Route::get('/search', [DoctorController::class, 'search']);

Route::post('/record', [RecordController::class, 'record'])->middleware('user_token');
Route::get('/record/{record}', [RecordController::class, 'show'])->middleware('user_token');
Route::get('/record/doctor/{doctor}/', [RecordController::class, 'getRecordByDoctor'])->middleware('user_token');

//Получение своих посещений
//Выход из личного кабинета