<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AxieAccountController;

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

Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('account', AxieAccountController::class);
    //account
    Route::get('/fetchOwnAccounts', [AxieAccountController::class, 'fetchOwnAccounts']);
    Route::get('/editAccount/{id}', [AxieAccountController::class, 'edit']);
    Route::put('/updateAccount/{id}', [AxieAccountController::class, 'update']);
    Route::delete('/deleteAccount/{id}', [AxieAccountController::class, 'destroy']);
});

Auth::routes();


