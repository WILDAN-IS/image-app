<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/admin/menu/add', [ImageController::class, 'index']);
Route::post('/create', [ImageController::class, 'create']);
Route::get('/show', [ImageController::class, 'show']);
Route::get('/edit/{image}', [ImageController::class, 'edit']);
Route::post('/update/{image}', [ImageController::class, 'update']);
Route::get('/delete/{image}', [ImageController::class, 'destroy']);

