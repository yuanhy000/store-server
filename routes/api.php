<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('force-json')->group(function () {
    Route::get('banner/{id}', 'BannerController@getBanner');

    Route::get('theme', 'ThemeController@getSimpleList');
    Route::get('theme/{id}', 'ThemeController@getComplexOne');

    Route::get('category/all', 'CategoryController@getAllCategories');

    Route::get('product/by_category', 'ProductController@getAllInCategory');
    Route::get('product/{id}', 'ProductController@getOne');

    Route::post('token/user', 'TokenController@getToken');
    Route::post('token/app', 'TokenController@getAppToken');
    Route::post('token/check', 'TokenController@checkToken');

    Route::middleware('check-primary-scope')->
    post('address', 'AddressController@createOrUpdateAddress');

    Route::middleware('check-primary-scope')->
    post('address/get', 'AddressController@getAddressInfo');

    Route::middleware('need-exclusive-scope')->
    post('order', 'OrderController@placeOrder');

    Route::middleware('need-exclusive-scope')->
    post('get_order_info', 'OrderController@getOrderInfo');

    Route::middleware('need-exclusive-scope')->
    post('get_order_list', 'OrderController@getOrderList');

    Route::/*middleware('need-exclusive-scope')->*/
    post('get_all_order', 'OrderController@getAllOrder');

    Route::middleware('need-exclusive-scope')->
    post('pay/pre_order', 'PayController@getPreOrder');

    Route::post('search/product', 'SearchController@getProduct');
});

Route::post('product/recent', 'ProductController@getRecent');

//Route::get('banner/{id}', 'BannerController@getBanner');

//Route::middleware('auth:api')->get('banner/{id}', 'BannerController@getBanner');
