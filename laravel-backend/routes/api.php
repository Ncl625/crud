<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\StudentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::get('/students', [StudentController::class, 'index']);
    Route::post('/students/create',[StudentController::class, 'create']);
    Route::get('/students/edit/{id}',[StudentController::class, 'edit']);
    Route::put('/students/update/{id}',[StudentController::class, 'update']);
    Route::delete('/students/delete/{id}',[StudentController::class, 'destroy']);

});

