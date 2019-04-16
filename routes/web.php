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
//登录后我的潮购
Route::get('userpage', 'IndexController@userpage')->middleware('logs');
//登录前我的潮购
Route::get('userpages', 'IndexController@userpages');
//所有商品
Route::get('allshops','IndexController@allshops');
//购物车页面
Route::get('shopcart','IndexController@shopcart')->middleware('log');
//商品详情页
Route::get('shopcontent','IndexController@shopcontent');
//所有商品页面
Route::any('allshopsdo','IndexController@allshopsdo');
//首页跳所有商品页面
Route::any('allshopsdoo','IndexController@allshopsdoo');
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
//支付页面
route::get('payment','IndexController@payment');
route::post('paymentdo','IndexController@paymentdo');

//支付成功页面
route::get('paysuccess','IndexController@paysuccess');
//潮购记录
route::get('recorddetail','IndexController@recorddetail');
//我的钱包
route::get('mywallet','IndexController@mywallet');
//验证码
Route::any('verify/create','CodeController@create');

//登录注册的相关路由
Route::prefix('login')->group(function(){
    route::get('login','user\LoginController@login');
    route::post('logindo','user\LoginController@logindo');
    route::get('register','user\LoginController@register');
    route::get('registers','user\LoginController@registers');
    route::post('registerdo','user\LoginController@registerdo');
    route::get('regauth','user\LoginController@regauth');
    route::post('regauthdo','user\LoginController@regauthdo');
    route::get('setpwd','user\LoginController@setpwd');
    //手机号短信
        route::post('codedo','user\LoginController@codedo');


});

//收货地址的相关路由
Route::prefix('address')->group(function(){
   route::get('address','address\AddressController@address');
    route::post('addaddress','address\AddressController@addaddress');
    route::get('addre','address\AddressController@addre');
    route::post('adddo','address\AddressController@adddo');
    route::post('adddel','address\AddressController@adddel');
    route::post('defaults','address\AddressController@defaults');
    route::get('addressedit','address\AddressController@addressedit');
    route::post('editdo','address\AddressController@editdo');
});

//支付
Route::prefix('alipay')->group(function(){
    route::get('mobilepay','AlipayController@mobilepay');

});
Route::any('goods','IndexController@goods');
Route::post('logindo','IndexController@logindo');
Route::get('pw','IndexController@pw');
Route::post('pwdo','IndexController@pwdo');


Route::prefix('user')->group(function(){
   route::get('registers','user\RegisterController@register');
    route::post('registerdo','user\RegisterController@registerdo');
    route::get('login','user\RegisterController@login');
    route::post('logindo','user\RegisterController@logindo');
    route::get('list','user\RegisterController@lists');
    route::post('codedo','user\RegisterController@codedo');
});


Route::any('check','Wechat\\WechatController@check');

route::post('updo',"Wechat\\MaterialController@updo");
route::get('material',"Wechat\\MaterialController@material");

//后台
Route::prefix('admin')->group(function(){
    route::get('index','admin\\UserController@index');
    route::get('event','admin\\UserController@event');
    route::get('type','admin\\UserController@type');
    route::post('doadd','admin\\UserController@doadd');
    route::post('typedo','admin\\UserController@typedo');
    route::get('menu','admin\\UserController@menu');
    route::post('menudo','admin\\UserController@menudo');
    route::any('getMenuList','admin\\UserController@getMenuList');
    route::get('menulist','admin\\UserController@menulist');
    route::post('getmenu','admin\\UserController@getmenu');
    route::get('setall','Admin\\GroupController@setUser');
    route::get('preson','admin\\UserController@preson');
    route::get('label','admin\\GroupController@label');
    route::get('set','admin\\GroupController@set');
    route::get('aa','admin\\GroupController@aa');
    route::get('template','admin\\GroupController@template');
});

Route::prefix('exam')->group(function(){
    route::any('check','exam\\ExamController@check');
    route::get('menu','exam\\ExamController@menu');
});