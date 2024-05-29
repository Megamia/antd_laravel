<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::view('/', "App");
Route::view('/{any}', "app")->where("any", ".*");