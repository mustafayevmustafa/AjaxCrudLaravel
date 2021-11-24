<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts',[\App\Http\Controllers\PostController::class,'index']);
Route::get('/post-add',[\App\Http\Controllers\PostController::class,'add'])->name('post-add');
Route::post('/post-save',[\App\Http\Controllers\PostController::class,'save'])->name('post-save');
Route::post('/post-delete',[\App\Http\Controllers\PostController::class,'delete'])->name('post-delete');
Route::get('/post-edit/{id}',[\App\Http\Controllers\PostController::class,'edit'])->name('post-edit');
Route::post('/post-update',[\App\Http\Controllers\PostController::class,'update'])->name('post-update');
