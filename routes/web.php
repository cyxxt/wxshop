<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//微商场首页
Route::any('/', 'IndexController@index');
//我的潮购
Route::get('userpage', 'IndexController@userpage');
//所有商品
Route::get('allshops','IndexController@allshops');
//购物车
Route::get('shopcart','IndexController@shopcart')->middleware('log');
//详情页
Route::get('shopcontent','IndexController@shopcontent');
//详情
Route::any('allshopsdo','IndexController@allshopsdo');
//添加至购物车
route::post('cart','IndexController@cart');
//搜索
route::post('search','IndexController@search');
//删除
route::post('del','IndexController@del');
//加
route::post('jia','IndexController@jia');
//删除全部
route::post('delall','IndexController@delall');
route::get('payment','IndexController@payment');
route::post('paymentdo','IndexController@paymentdo');

//验证码
Route::any('verify/create','CodeController@create');
Route::prefix('login')->group(function(){
    route::get('login','user\LoginController@login');
    route::post('logindo','user\LoginController@logindo');
    route::get('register','user\LoginController@register');
    route::post('registerdo','user\LoginController@registerdo');

    //手机号短信
        route::post('codedo','user\LoginController@codedo');


});