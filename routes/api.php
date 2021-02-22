<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('articles',[ArticleController::class,'index']);
Route::prefix('/articles') -> group( function (){
    Route::get('/{id}',[ArticleController::class,'show']);
    Route::delete('/{id}',[ArticleController::class,'destroy']);
});


Route::get('cart',[CartController::class,'api']);
Route::get('cart/{id}',[CartController::class,'show']);
Route::put('cart',[CartController::class,'store']);
Route::delete('cart/{id}',[CartController::class,'destroy']);
Route::post('bracelets/buy/{id}',[CartController::class,'addToCart']);

//Route::get('article/{id}',[ArticleController::class,'show']);
//Route::prefix('/article')->group( function () {
//        Route::post('/store',[ArticleController::class,'store']);
//        Route::put('/{id}',[ArticleController::class,'update']);
//        Route::delete('/{id}',[ArticleController::class,'delete']);
//});
