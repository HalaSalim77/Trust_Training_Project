<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/products' , function(){
//    return 'test api ';  
// });


//== index mehtod in ProductsController Api  
// Route::get('/products', function () {
//     return Products::all();  // will return empty array
// });

//Add product
// Route::post('/products', function(){ 
//      return Products::create([
//              'name'=>'product one test',
//              'description' =>'this is product one',
//              'slug'=>'product_one',
//              'price'=>'100.00'
//      ]);
//      //we should have a controller to make this 
// });




//insted of write route in this way we can use resourse
// Route::resource('products', ProductController::class);


// public routes 
//route for new mehtod that i have been created = search 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/products' , [ProductController::class , 'index']);
Route::get('/products/search/{name}' , [ProductController::class , 'search']);
Route::get('/products/{id}', [ProductController::class, 'show']);



//protected  routes  need token (  "message": "Unauthenticated." ) 

Route::group(['middleware' => ['auth:sanctum']], function () {
     Route::post('/products' , [ProductController::class , 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);

});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


