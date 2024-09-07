<?php

use App\Http\Controllers\Admin\SeriesController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function(){
    return response()->json(["message" => "Api route up for customer"]);
});


Route::group(['middleware' => ['auth', 'customer']], function () {
    Route::get('/status', function (){
        return response()->json(["message" => "Api route up for customer status"]);
    });
});
