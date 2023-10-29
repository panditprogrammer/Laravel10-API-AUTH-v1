<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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


Route::get("/students",[StudentController::class,"index"]);
Route::get("/students/{id}",[StudentController::class,"show"]);


// student routes with sanctum auth
// Route::middleware('auth:sanctum')->delete("/students/{id}",[StudentController::class,"destroy"]);
// Route::middleware('auth:sanctum')->post("/students",[StudentController::class,"store"]);
// Route::middleware('auth:sanctum')->put("/students/{id}",[StudentController::class,"update"]);
// Route::middleware('auth:sanctum')->post("/students",[StudentController::class,"store"]);


// route grouping with middleware (same as above)
Route::middleware(["auth:sanctum"])->group(function(){
    Route::delete("/students/{id}",[StudentController::class,"destroy"]);
    Route::post("/students",[StudentController::class,"store"]);
    Route::put("/students/{id}",[StudentController::class,"update"]);
    Route::post("/students",[StudentController::class,"store"]);
});



// User routes 
Route::post("/user/register",[UserController::class,"register"]);
Route::post("/user/login",[UserController::class,"login"]);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/user/logout',[UserController::class,"logout"]);
