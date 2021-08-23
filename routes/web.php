<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ItemController;

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::post('storeing', [TransactionController::class,'store']);
Route::prefix('transaction')->name('transaction.')->group(function ()
{
});
Route::group(['middleware' => 'auth'], function () {
    
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::resource('transaction', TransactionController::class);

    Route::prefix('items')->name('items.')->group(function ()
    {
        Route::get('/', [ItemController::class, 'get'])->name('get');
    });

});
