<?php

use Illuminate\Http\Request;


Route::group([
    'prefix' => 'v1'
], function(){
    /** RESTfull API V1 : Design by VianDwi */
    Route::group([
        'middleware' => ['api'],
        'prefix' => 'auth'
    ], function ($router) {
        // AUTH
        Route::post('login', 'Api\V1\AuthController@login')->name('login');
        Route::post('logout', 'Api\V1\AuthController@logout');
        Route::post('refresh', 'Api\V1\AuthController@refresh');
        Route::post('me', 'Api\V1\AuthController@me');
    });
    
    /** BARANG */
    Route::apiResource('barang', 'Api\V1\BarangController');
    Route::apiResource('barang-rusak', 'Api\V1\BarangRusakController');
    
    /** ROLE and PERMISSION */
    Route::get('role/{name}', 'Api\V1\RoleController@show_byname')->where('name', '[A-Za-z]+');
    Route::put('role/{id}/sync', 'Api\V1\RoleController@sync_permission');
    Route::apiResource('role', 'Api\V1\RoleController');
    Route::apiResource('permission', 'Api\V1\PermissionController');
});