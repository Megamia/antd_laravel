<?php

use App\Http\Controllers\inforUserOrderController;
use Illuminate\Support\Facades\Route;

Route::get('dataUser', [inforUserOrderController::class, 'data']);
Route::post('dataUserOrder', [inforUserOrderController::class, 'dataUserOrder']);
Route::post('addUserOrder', [inforUserOrderController::class, 'addUserOder']);
