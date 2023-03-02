<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController as ApiBookController;

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

Route::prefix( 'v1' )->middleware( 'api' )->group( function () {
    Route::get( 'list-books', [ ApiBookController::class, 'listBooks' ] )
         ->name( 'list-books' );
} );
