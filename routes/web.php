<?php

use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\BraceletsController;
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

Route::resource('bracelets','BraceletsController');
Route::post('bracelets/buy/{id}',[CartController::class,'addToCart']);

Route::resource('articles','ArticlesController');
Route::post('articles/{articleId}/edit/{partnerId}',[ArticlesController::class,'removePartner']);

Route::resource('partners','PartnersController',['except'=> [
    'show'
]]);

Route::get('cart',[CartController::class,'index']);

Route::resource('profile','ProfileController',['except' => [
    'index','create','store','destroy'
]]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

