<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserPhoneController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// //traits part 

// Route::get('/students', [StudentController::class , 'index' ]);


Route::get('/', [UserPhoneController::class , 'show']);
Route::post('/', [UserPhoneController::class ,  'storePhoneNumber']);
Route::post('/custom', [UserPhoneController::class , 'sendCustomMessage']);
