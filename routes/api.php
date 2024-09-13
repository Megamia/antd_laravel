<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\DetailInforUserOrderController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\DetailOrderController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

//DetailInforUserOrder
Route::get('dataUser', [DetailInforUserOrderController::class, 'data']);
Route::post('chooseUserOrder', [DetailInforUserOrderController::class, 'chooseUserOrder']);
Route::post('dataUserOrder', [DetailInforUserOrderController::class, 'dataUserOrder']);
Route::post('deleteSession', [DetailInforUserOrderController::class, 'deleteSession']);
Route::post('addUserOrder', [DetailInforUserOrderController::class, 'addUserOrder']);
Route::post('newDataUserOrderAfterSwap', [AddressController::class, 'newDataUserOrderAfterSwap']);
Route::get('inforUserCRM', [DetailInforUserOrderController::class, 'inforUserCRM']);
//DetailInforUserOrder

//Address
Route::get('inforAddress', [AddressController::class, 'inforAddress']);
Route::post('swapAnotherAddress', [AddressController::class, 'swapAnotherAddress']);
Route::delete('DeleteAddress/{id}', [AddressController::class, 'DeleteAddress']);
Route::post('FetchDataAddress', [AddressController::class, 'FetchDataAddress']);
Route::post('AddNewAddress', [AddressController::class, 'AddNewAddress']);
Route::post('DetailAddressWithIdUser', [AddressController::class, 'DetailAddressWithIdUser']);
Route::post('SwapAddress', [AddressController::class, 'SwapAddress']);
//Address

// DetailProduct
Route::get('inforProduct', [DetailProductController::class, 'inforProduct']);
Route::post('uploads', [DetailProductController::class, 'upload']);
Route::get('showImg', [DetailProductController::class, 'showImg']);
Route::post('addNewProduct', [DetailProductController::class, 'addNewProduct']);
Route::post('choosedProduct', [DetailProductController::class, 'choosedProduct']);
Route::post('updatePriceProduct', [DetailProductController::class, 'updatePriceProduct']);
Route::post('inforProductWithTag', [DetailProductController::class, 'inforProductWithTag']);
// DetailProduct

//Product
Route::post('productSelected', [ProductController::class, 'productSelected']);
//Product

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

//DetailOrder
Route::post('createDetailOrder', [DetailOrderController::class, 'createDetailOrder']);
//DetailOrder

//Order
Route::post('createOrder', [OrderController::class, 'createOrder']);
Route::post('createOrderWithoutValue', [OrderController::class, 'createOrderWithoutValue']);
Route::post('createVoucher', [OrderController::class, 'createVoucher']);
Route::post('createDetailOrderWithoutValue', [OrderController::class, 'createDetailOrderWithoutValue']);
Route::post('createProduct', [OrderController::class, 'createProduct']);
Route::post('createDetailOrderWithValue', [OrderController::class, 'createDetailOrderWithValue']);
Route::post('createOrderWithValue', [OrderController::class, 'createOrderWithValue']);
//Order
