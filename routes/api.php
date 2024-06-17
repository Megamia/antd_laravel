<?php

use App\Http\Controllers\addressController;
use App\Http\Controllers\inforUserOrderController;
use Illuminate\Support\Facades\Route;

Route::get('dataUser', [inforUserOrderController::class, 'data']);
Route::post('chooseUserOrder', [inforUserOrderController::class, 'chooseUserOrder']);
Route::get('dataUserOrder',[inforUserOrderController::class,'dataUserOrder']);
Route::get('deleteSession',[inforUserOrderController::class,'deleteSession']);
Route::post('addUserOrder', [inforUserOrderController::class, 'addUserOder']);
Route::get('inforAddress',[addressController::class,'inforAddress']);
Route::post('swapAnotherAddress',[addressController::class,'swapAnotherAddress']);

Route::get('dataAfterSwap',[addressController::class,'dataAfterSwap']);

