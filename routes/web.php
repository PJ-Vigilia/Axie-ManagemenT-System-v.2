<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AxieAccountController;
use App\Http\Controllers\AxieController;
use App\Http\Controllers\SmoothLovePotionController;
use App\Http\Controllers\TransactionController;

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
    Route::get('/fetchHome', [App\Http\Controllers\HomeController::class, 'fetchHome']);

    //account
    Route::resource('account', AxieAccountController::class);
    Route::get('/fetchOwnAccounts', [AxieAccountController::class, 'fetchOwnAccounts']);
    Route::get('/editAccount/{id}', [AxieAccountController::class, 'edit']);
    Route::put('/updateAccount/{id}', [AxieAccountController::class, 'update']);
    Route::delete('/deleteAccount/{id}', [AxieAccountController::class, 'destroy']);
    Route::get('/fetchAccountName', [AxieAccountController::class, 'fetchAccountName']);
    Route::get('/fetchName/{id}', [AxieAccountController::class, 'fetchName']);
    Route::get('/view/account/{id}', [AxieAccountController::class, 'account']);
    Route::get('/fetchAccount/{id}', [AxieAccountController::class, 'fetchAccount']);
    Route::post('/deleteThisAccount', [AxieAccountController::class, 'deleteAccount']);
    //axie
    Route::resource('axie', AxieController::class);
    Route::get('/fetchOwnAxie', [AxieController::class, 'fetchOwnAxie']);
    Route::get('/editAxie/{id}', [AxieController::class, 'edit']);
    Route::put('/updateAxie/{id}', [AxieController::class, 'update']);
    Route::delete('/deleteAxie/{id}', [AxieController::class, 'destroy']);
    Route::get('/fetchAccountAxie/{id}', [AxieController::class, 'fetchAccountAxie']);
    Route::post('/storeAccountAxie', [AxieController::class, 'storeAccountAxie']);
    Route::put('/updateAccountAxie/{id}', [AxieController::class, 'updateAccountAxie']);
    //slp
    Route::resource('slp', SmoothLovePotionController::class);
    Route::get('/fetchSLP', [SmoothLovePotionController::class, 'fetchSLP']);
    Route::delete('/deleteSLPAccount/{id}', [SmoothLovePotionController::class, 'deleteSLPAccount']);
    Route::post('/storeAccountSLP', [SmoothLovePotionController::class, 'storeAccountSLP']);
    Route::get('/fetchAccountSLP/{id}', [SmoothLovePotionController::class, 'fetchAccountSLP']);
    Route::put('/updateAccountSLP/{id}', [SmoothLovePotionController::class, 'updateAccountSLP']);
    Route::delete('/deleteAccountSLP/{id}', [SmoothLovePotionController::class, 'deleteAccountSLP']);
    //transaction
    Route::resource('transaction', TransactionController::class);
    Route::get('/fetchTransaction', [TransactionController::class, 'fetchTransaction']);
    Route::delete('/deleteTransaction', [TransactionController::class, 'destroy']);
    Route::get('/fetchAccountTransaction/{id}', [TransactionController::class, 'fetchAccountTransaction']);
    Route::post('/storeAccountTransaction', [TransactionController::class, 'storeAccountTransaction']);
    Route::get('/editAccountTransaction/{id}', [TransactionController::class, 'edit']);
    Route::post('/updateAccountTransaction', [TransactionController::class, 'updateAccountTransaction']);
    Route::delete('/deleteAccountTransaction/{id}', [TransactionController::class, 'deleteAccountTransaction']);
});

Auth::routes();


