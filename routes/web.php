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

Route::get('/', function () {
    return view('welcome');
});

//pc端
Route::get('/userlogin', 'User\UserController@loginView');//访问登录页面
Route::post('/userlogin', 'User\UserController@loginAction');//登录页面

//移动端
Route::get('/apilogin','User\UserController@alogin'); //访问登录页面
Route::post('/apilogin','User\UserController@apilogins'); //登录页面


Route::get('/goods','Goods\GoodsControllers@show');//商品展示
Route::get('/goodsadd','Goods\GoodsControllers@showadd');//商品详情
Route::get('/cart','Goods\UserController@cart');//购物车展示
Route::get('/cartadd','Goods\GoodsControllers@cartadd');//加入购物车


Route::get('/cartadd2','Goods\GoodsControllers@cartadd2');//点赞

Route::post('/cartadd5','Goods\GoodsControllers@cartadd5');//点赞列表

Route::get('/cartadd3','Goods\GoodsControllers@cartadd3');//收藏

Route::post('/cartadd4','Goods\GoodsControllers@cartadd4');//收藏列表



Route::post('/order','Order\IndexController@add');//生成订单
Route::get('/order/show','Order\IndexController@show');//订单展示

