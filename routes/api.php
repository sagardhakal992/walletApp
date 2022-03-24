<?php

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


Route::group(['middleware'=>'auth:sanctum'],function (){
    //return user basic info with total amounts of money
    Route::get('/',[\App\Http\Controllers\UserInfoController::class,'index'])->name('home');

    Route::group(['as'=>'transactions.'],function(){
        Route::post('/deposit',[\App\Http\Controllers\TransactionsController::class,'deposit'])->name('deposit');

        //accepts receiver_email and amount and sends amount with another user
        Route::post('/send',[\App\Http\Controllers\TransactionsController::class,'sendMoney'])->name('send');
        //returns sent and recieved transactions history
        Route::get('/transactions',[\App\Http\Controllers\TransactionsController::class,'transactions'])->name('history');
    });

});




Route::group(['prefix'=>'auth'],function(){
    Route::post('/signup',[\App\Http\Controllers\UserController::class,'store'])->name('singup');
    Route::post('/login',[\App\Http\Controllers\UserController::class,'login'])->name('login');
    Route::post('/logout',[\App\Http\Controllers\UserController::class,'login'])->name('logout');
});






//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
