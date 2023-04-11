<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AlbumController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'login']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::resource('album', AlbumController::class);
    Route::get('other-album/{id}', [AlbumController::class, 'getOtherAlbums']);
    Route::post('delete-album-action', [AlbumController::class, 'deleteAlbum']);

});
