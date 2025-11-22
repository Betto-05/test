<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testControllers;

Route::middleware('api')->group(function () {
    Route::apiResource('tests', testControllers::class);
});
