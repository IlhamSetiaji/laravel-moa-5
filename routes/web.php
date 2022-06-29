<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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



Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class,'storeLogin']);

Route::middleware('auth')->group(function(){
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::middleware('is.admin')->group(function(){
        Route::get('/admin',[AdminController::class,'index']);
        Route::get('/admin/add-book',[AdminController::class,'addBooks']);
        Route::post('/admin/add-book',[AdminController::class,'storeBook']);
        Route::get('/admin/{bookID}/edit-book',[AdminController::class,'editBook']);
        Route::post('/admin/{bookID}/edit-book',[AdminController::class,'updateBook']);
        Route::get('/admin/{bookID}/delete-book',[AdminController::class,'deleteBook']);
    });
    Route::middleware('is.user')->group(function(){
        Route::get('/', function () {
            return view('welcome');
        });
    });
});
