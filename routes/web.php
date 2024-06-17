<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::prefix('/api')->group(function () {
    include_once __DIR__.'/api.php';
});

Route::view('/', "App");
Route::view('/{any}', "app")->where("any", ".*");
