<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BankAccountController;
use App\Http\Controllers\Api\V1\DepositController;
use App\Http\Controllers\Api\V1\LuckySpinController;
use App\Http\Controllers\Api\V1\PaymentHistoryController;
use App\Http\Controllers\Api\V1\ThreedLedgerController;
use App\Http\Controllers\Api\V1\TwodHistoryController;
use App\Http\Controllers\Api\V1\TwodledgerController;
use App\Http\Controllers\Api\V1\WithdrawlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('v1/login',[AuthController::class,'loginUser']);
    Route::post('v1/register',[AuthController::class,'register']);



Route::group(['middleware' => 'auth:sanctum','prefix' => 'v1',],function(){
    Route::get('logout',[AuthController::class,'logout']);
    Route::get('user_detail',[AuthController::class,'userDetails']);
    Route::post('deposit-request',[DepositController::class,'depositRequest']);
    Route::post('withdrawl',[WithdrawlController::class,'withdrawlRequest']);
    Route::post('bank-account',[BankAccountController::class,'getBankAccount']);
    Route::post('payment-history',[PaymentHistoryController::class,'getPaymentHistory']);
    Route::get('twod-number',[TwodledgerController::class,'allNumber']);
    Route::get('threed-number',[ThreedLedgerController::class,'allNumber']);
    Route::post('twod-bet',[TwodledgerController::class,'twodBet']);
    Route::post('threed-bet',[ThreedLedgerController::class,'threedBet']);
    Route::post('lucky-spin',[LuckySpinController::class,'luckySpin']);
    Route::get('twod-threed-history',[TwodHistoryController::class,'TwodHistory']);
});
Route::get('v1/test', [AuthController::class,'test']);
Route::post('v1/test/post', [AuthController::class,'postTest']);
