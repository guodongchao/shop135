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

Route::get('/goods','Goods\GoodsControllers@show');
Route::get('/goodsadd','Goods\GoodsControllers@showadd');
Route::get('cart','Goods\UserController@cart');
Route::get('/cartadd','Goods\GoodsControllers@cartadd');

