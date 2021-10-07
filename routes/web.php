<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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
    return redirect('/books');
});

Use App\Http\Controllers\BooksController;
Route::resource('books', 'App\Http\Controllers\BooksController');

Route::get('upload/{book_id}',function ($book_id) {
    return BooksController::upload($book_id);
});

use App\Http\Controllers\UserController;
Route::get('user', [ UserController::class, 'index' ]);
Route::get( 'user/logout', [UserController::class, 'logout']);

require __DIR__.'/auth.php';
