<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\BookController as AdminBookController;

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

Route::get( '/', [ BookController::class, 'index' ] )->name( 'default' );
Route::get( '/home', [ BookController::class, 'index' ] )->name( 'home' );

Route::get( '/import-books', [ BookController::class, 'importBooks' ] )->name( 'import-books' );
Route::get( '/book/{id}', [ BookController::class, 'getBook' ] )->name( 'get-book' );
Route::get( '/books', [ BookController::class, 'index' ] )->name( 'books' );

Route::prefix( 'admin' )->as( 'admin.' )->middleware( [ 'auth', 'admin' ] )->group( function () {
    Route::get( '/dashboard', [ AdminHomeController::class, 'dashboard' ] )->name( 'dashboard' );
    Route::resource( 'books', AdminBookController::class );
} );

Auth::routes();

