<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataSiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DataSiswaController::class, 'createToken']);

// Route::get('/', [DataSiswaController::class, 'createToken']);
// Route::get('/datasiswa', [DataSiswaController::class, 'index']);
// Route::post('/datasiswa/store', [DataSiswaController::class, 'store']);
// Route::get('/datasiswa/{id}', [DataSiswaController::class, 'show']);
// Route::patch('/datasiswa/update/{id}', [DataSiswaController::class, 'update']);
// Route::delete('/datasiswa/delete/{id}', [DataSiswaController::class, 'destroy']);