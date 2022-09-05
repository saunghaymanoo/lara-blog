<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function(){
    Route::resource('/category',CategoryController::class);
    Route::resource('/post',PostController::class);
    Route::resource('/user',UserController::class);
    Route::resource('/photo',PhotoController::class); 
});

Route::get('/',[PageController::class,'index'])->name('page.index');
Route::get('/detail/{slug}',[PageController::class,'detail'])->name('page.detail');
Route::get('/postbycategory/{category:slug}',[PageController::class,'postByCategory'])->name('page.postbycategory');
Route::get('/pdf/{slug}',[PageController::class,'pdfDownload'])->name('page.pdf');



