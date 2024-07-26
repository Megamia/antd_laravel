<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\InforUserOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserCRMController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::get('dataUser', [InforUserOrderController::class, 'data']);
Route::post('chooseUserOrder', [InforUserOrderController::class, 'chooseUserOrder']);
Route::get('dataUserOrder', [InforUserOrderController::class, 'dataUserOrder']);
Route::get('deleteSession', [InforUserOrderController::class, 'deleteSession']);
Route::post('addUserOrder', [InforUserOrderController::class, 'addUserOder']);
Route::post('newDataUserOrderAfterSwap', [AddressController::class, 'newDataUserOrderAfterSwap']);

//Address
Route::get('inforAddress', [AddressController::class, 'inforAddress']);
Route::post('swapAnotherAddress', [AddressController::class, 'swapAnotherAddress']);
Route::delete('deleteAddress/{id}', [AddressController::class, 'deleteAddress']);
Route::get('dataAfterSwap', [AddressController::class, 'dataAfterSwap']);
Route::post('addNewAddress', [AddressController::class, 'addNewAddress']);
//Address

// Product
Route::get('inforProduct', [ProductController::class, 'inforProduct']);
Route::post('uploads', [ProductController::class, 'upload']);
Route::get('showImg', [ProductController::class, 'showImg']);
Route::post('addNewProduct', [ProductController::class, 'addNewProduct']);
Route::post('choosedProduct', [ProductController::class, 'choosedProduct']);
Route::post('updatePriceProduct', [ProductController::class, 'updatePriceProduct']);
Route::post('inforProductWithTag', [ProductController::class, 'inforProductWithTag']);
// Product

//Tag
Route::get('itemFilterWithTag', [TagController::class, 'itemFilterWithTag']);
Route::post('titleFilterWithTag', [TagController::class, 'titleFilterWithTag']);
Route::post('choosedTag', [TagController::class, 'choosedTag']);
Route::post('dataTagItem', [TagController::class, 'dataTagItem']);
//Tag

//VoucherPromotion
Route::get('dataValueVoucherPromotion', [VoucherController::class, 'dataValueVoucherPromotion']);
Route::post('chooseVoucherPromotion', [VoucherController::class, 'chooseVoucherPromotion']);
//VoucherPromotion

//VoucherCode
Route::get('dataValueVoucherCode', [VoucherController::class, 'dataValueVoucherCode']);
Route::post('chooseVoucherCode', [VoucherController::class, 'chooseVoucherCode']);
//VoucherCode

//UserCRM
Route::get('inforUserCRM', [UserCRMController::class, 'inforUserCRM']);
//UserCRM