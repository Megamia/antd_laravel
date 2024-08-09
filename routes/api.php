<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\DetailInforUserOrderController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\DetailOrderController;
use App\Http\Controllers\InforUserController;
use Illuminate\Support\Facades\Route;

//DetailInforUserOrder
Route::get('dataUser', [DetailInforUserOrderController::class, 'data']);
Route::post('chooseUserOrder', [DetailInforUserOrderController::class, 'chooseUserOrder']);
Route::get('dataUserOrder', [DetailInforUserOrderController::class, 'dataUserOrder']);
Route::get('deleteSession', [DetailInforUserOrderController::class, 'deleteSession']);
Route::post('addUserOrder', [DetailInforUserOrderController::class, 'addUserOrder']);
Route::post('newDataUserOrderAfterSwap', [AddressController::class, 'newDataUserOrderAfterSwap']);
Route::get('inforUserCRM', [DetailInforUserOrderController::class, 'inforUserCRM']);
//DetailInforUserOrder

//Address
Route::get('inforAddress', [AddressController::class, 'inforAddress']);
Route::post('swapAnotherAddress', [AddressController::class, 'swapAnotherAddress']);
Route::delete('deleteAddress/{id}', [AddressController::class, 'deleteAddress']);
Route::get('dataAfterSwap', [AddressController::class, 'dataAfterSwap']);
Route::post('addNewAddress', [AddressController::class, 'addNewAddress']);
Route::post('DetailAddressWithIdUser', [AddressController::class, 'DetailAddressWithIdUser']);
//Address

//InforUser
Route::post('AddressUserWithId', [InforUserController::class, 'AddressUserWithId']);
Route::post('AddNewInforUser', [InforUserController::class, 'AddNewInforUser']);
//InforUser

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
Route::post('addDetailOrder', [DetailOrderController::class, 'addDetailOrder']);

//DetailOrder
