<?php

use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\BraceletsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PartnersController;
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

Route::get('/','MainController@index');

//Route::resource('bracelets','BraceletsController');
Route::get('bracelets',[BraceletsController::class,'index']) -> name('bracelets');

Route::prefix('bracelets') ->group(function (){
    Route::get('/create',[BraceletsController::class,'create']);
    Route::post('/',[BraceletsController::class,'store']);
    Route::get('/{id}',[BraceletsController::class,'show']);
    Route::get('/{id}/edit',[BraceletsController::class,'edit']);
    Route::put('/{id}',[BraceletsController::class,'update']);
    Route::delete('/{id}',[BraceletsController::class,'destroy']);

    Route::post('/buy/{id}',[CartController::class,'addToCart']);
});


//Route::resource('articles','ArticlesController');
Route::get('articles',[ArticlesController::class,'index']) -> name('articles');

Route::prefix('articles') ->group(function (){
    Route::get('/create',[ArticlesController::class,'create']);
    Route::post('/',[ArticlesController::class,'store']);
    Route::get('/{id}',[ArticlesController::class,'show']);
    Route::get('/{id}/edit',[ArticlesController::class,'edit']);
    Route::put('/{id}',[ArticlesController::class,'update']);
    Route::delete('/{id}',[ArticlesController::class,'destroy']);

    Route::post('/{articleId}/edit/{partnerId}',[ArticlesController::class,'removePartner']);
});


Route::resource('partners','PartnersController',['except'=> [
    'show'
]]);

Route::get('cart',[CartController::class,'index']) -> name('cart');

//Route::resource('profile','ProfileController',['except' => [
//    'index','create','store','destroy'
//]]);
Route::prefix('profile') ->group(function (){
    Route::get('/{id}',[ProfileController::class,'show']);
    Route::get('/{id}/edit',[ProfileController::class,'edit']);
    Route::put('/{id}',[ProfileController::class,'update']);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

