<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SowlutionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'problem1'], function(){
    Route::get('/toCamelCase/{str}', [SowlutionController::class, 'toCamelCase']);
    Route::get('/toPascalCase/{str}', [SowlutionController::class, 'toPascalCase']);
    Route::get('/toKebabCase/{str}', [SowlutionController::class, 'toKebabCase']);
    Route::get('/toSnakeCase/{str}', [SowlutionController::class, 'toSnakeCase']);
});

Route::group(['prefix'=>'problem2'], function(){
    Route::get('/predicutResult/{card}/{animal}/{fruit}', [SowlutionController::class, 'predicutResult']);

});

Route::group(['prefix'=>'problem3'], function(){
    Route::get('/filterData/{data}/{filter}', [SowlutionController::class, 'filterData']);
    Route::get('/transformData/{data}/{trans}', [SowlutionController::class, 'transformData']);
    Route::get('/sumData/{data}', [SowlutionController::class, 'sumData']);
    Route::get('/calculateAverage/{data}', [SowlutionController::class, 'calculateAverage']);
    Route::get('/findMax/{data}', [SowlutionController::class, 'findMax']);
    Route::get('/findMin/{data}', [SowlutionController::class, 'findMin']);
});

Route::group(['prefix'=>'problem4'], function(){
    Route::get('/', [SowlutionController::class, 'problem4']);
});

