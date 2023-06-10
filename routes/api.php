<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\EditorialController;
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


// la siguiente api no tiene token 


Route::group(['prefix' => 'v1'], function () {



    Route::group(['prefix' => 'editorials'], function () {

        Route::get('/',         [EditorialController::class, 'index'])->name('editorials.index');
        Route::get('/{id}',     [EditorialController::class, 'show'])->name('editorials.show');
        Route::post('/',        [EditorialController::class, 'store'])->name('editorials.store');
        Route::put('/{id}',     [EditorialController::class, 'update'])->name('editorials.update');
        Route::delete('/{id}',  [EditorialController::class, 'destroy'])->name('editorials.destroy');
      
    });

    Route::group(['prefix' => 'authors'], function () {

        Route::get('/',         [AuthorController::class, 'index'])->name('authors.index');
        Route::get('/{id}',     [AuthorController::class, 'show'])->name('authors.show');
        Route::post('/',        [AuthorController::class, 'store'])->name('authors.store');
        Route::put('/{id}',     [AuthorController::class, 'update'])->name('authors.update');
        Route::delete('/{id}',  [AuthorController::class, 'destroy'])->name('authors.destroy');
      
    });

    Route::group(['prefix' => 'books'], function () {

        Route::get('/',         [BookController::class, 'index'])->name('books.index');
        Route::get('/{id}',     [BookController::class, 'show'])->name('books.show');
        Route::post('/',        [BookController::class, 'store'])->name('books.store');
        Route::put('/{id}',     [BookController::class, 'update'])->name('books.update');
        Route::delete('/{id}',  [BookController::class, 'destroy'])->name('books.destroy');
      
    });
});
