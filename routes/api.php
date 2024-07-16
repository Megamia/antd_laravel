<?php

use App\Http\Controllers\addressController;
use App\Http\Controllers\inforUserOrderController;
use App\Http\Controllers\productController;
use App\Http\Controllers\voucherController;
use Illuminate\Support\Facades\Route;

Route::get('dataUser', [inforUserOrderController::class, 'data']);
Route::post('chooseUserOrder', [inforUserOrderController::class, 'chooseUserOrder']);
Route::get('dataUserOrder', [inforUserOrderController::class, 'dataUserOrder']);
Route::get('deleteSession', [inforUserOrderController::class, 'deleteSession']);
Route::post('addUserOrder', [inforUserOrderController::class, 'addUserOder']);
Route::post('newDataUserOrderAfterSwap', [addressController::class, 'newDataUserOrderAfterSwap']);

Route::get('inforAddress', [addressController::class, 'inforAddress']);
Route::post('swapAnotherAddress', [addressController::class, 'swapAnotherAddress']);
Route::delete('deleteAddress/{id}', [addressController::class, 'deleteAddress']);
Route::get('dataAfterSwap', [addressController::class, 'dataAfterSwap']);


// Product
Route::get('inforProduct', [productController::class, 'inforProduct']);
Route::post('uploads', [productController::class, 'upload']);
Route::get('showImg', [productController::class, 'showImg']);
Route::post('addNewProduct', [productController::class, 'addNewProduct']);
Route::post('choosedProduct', [productController::class, 'choosedProduct']);
Route::post('updatePriceProduct', [productController::class, 'updatePriceProduct']);

// Product

//VoucherPromotion
Route::get('dataValueVoucherPromotion', [voucherController::class, 'dataValueVoucherPromotion']);
Route::post('chooseVoucherPromotion', [voucherController::class, 'chooseVoucherPromotion']);
//VoucherPromotion

//VoucherCode
Route::get('dataValueVoucherCode', [voucherController::class, 'dataValueVoucherCode']);
Route::post('chooseVoucherCode', [voucherController::class, 'chooseVoucherCode']);

//VoucherCode
