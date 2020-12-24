<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
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
Route::resource('articles','ArticlesController');

Route::post('articles/{articleId}/edit/{partnerId}',[ArticlesController::class,'removePartner']);

Route::resource('partners','PartnersController');

Route::resource('profile','ProfileController');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

