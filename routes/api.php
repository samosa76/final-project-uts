<?php

use App\Http\Controllers\NewsController;
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

// Route::get('/news', [NewsController::class, 'index']);
// Route::post('/news', [NewsController::class, 'store']);
// Route::get('/news/{id}', [NewsController::class, 'show']);
// Route::put('/news{id}', [NewsController::class, 'update']);
// Route::delete('/news/{id}', [NewsController::class, 'destroy']);

//CRUD normal 
Route::apiResource('news', NewsController::class);

//get by title
Route::get('/news/search/{title}', [NewsController::class, 'search']);

//get by category
Route::get('/news/category/{category}', [NewsController::class, 'category']);


