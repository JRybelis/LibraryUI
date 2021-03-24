<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'authors'], function(){
    Route::get('',[AuthorController::class, 'index']) -> name ('author.index');
    Route::get('create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('store', [AuthorController::class, 'store']) -> name ('author.edit');
    Route::get('edit/{author}', [AuthorController::class, 'edit']) -> name ('author.edit');
    Route::post('update/{author}', [AuthorController::class, 'update']) -> name('author.update');
    Route::post('delete/{author}', [AuthorController::class, 'destroy']) -> name('author.destroy');
    Route::get('show/{author}', [AuthorController::class, 'show'])-> name('author.show');

});