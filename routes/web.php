<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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


// Route::get('/', [UserPhoneController::class , 'show']);
// Route::post('/', [UserPhoneController::class ,  'storePhoneNumber']);
// Route::post('/custom', [UserPhoneController::class , 'sendCustomMessage']);


//DESIGN PATTERN - Repository Pattern 
Route::get('/' , [CustomerController::class , 'index']);

Route::get('/customer/{customerId}', [CustomerController::class, 'show']);

Route::get('/customer/{customerId}/update', [CustomerController::class, 'update']);

Route::get('/customer/{customerId}/delete', [CustomerController::class, 'destroy']);

//user controller  
//R
Route::get('user/{id}', [UserController::class, 'index']);
Route::get('users', [UserController::class, 'listAll']);