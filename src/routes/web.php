<?php

use App\Http\Controllers\HomeController; 
use App\Http\Controllers\AuthorController; 
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\BookController; 
use App\Http\Controllers\DataController; 
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']); 

//Author routes
Route::get('/authors', [AuthorController::class, 'list']); 
Route::get('/authors/create', [AuthorController::class, 'create']); 
Route::post('/authors/put', [AuthorController::class, 'put']); 
Route::get('/authors/update/{author}', [AuthorController::class, 'update']); 
Route::post('/authors/patch/{author}', [AuthorController::class, 'patch']); 
Route::post('/authors/delete/{author}', [AuthorController::class, 'delete']); 

// Book routes 
Route::get('/books', [BookController::class, 'list']); 
Route::get('/books/create', [BookController::class, 'create']); 
Route::post('/books/put', [BookController::class, 'put']); 
Route::get('/books/update/{book}', [BookController::class, 'update']); 
Route::post('/books/patch/{book}', [BookController::class, 'patch']); 
Route::post('/books/delete/{book}', [BookController::class, 'delete']); 

// Genre routes 
Route::get('/genres', [GenreController::class, 'list']); 
Route::get('/genres/create', [GenreController::class, 'create']); 
Route::post('/genres/put', [GenreController::class, 'put']); 
Route::get('/genres/update/{book}', [GenreController::class, 'update']); 
Route::post('/genres/patch/{book}', [GenreController::class, 'patch']); 
Route::post('/genres/delete/{book}', [GenreController::class, 'delete']); 


// Auth routes 
Route::get('/login', [AuthController::class, 'login'])->name('login'); 
Route::post('/authenticate', [AuthController::class, 'authenticate']); 
Route::get('/logout', [AuthController::class, 'logout']); 

// Data routes 
Route::prefix('data')->group(function()
{
    Route::get('/get-top-books', [DataController::class, 'getTopBooks']);
    Route::get('/get-book/{book}', [DataController::class, 'getBook']);
    Route::get('/get-related-books/{book}', [DataController::class, 'getRelatedBooks']);
});


