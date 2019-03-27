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
<<<<<<< HEAD
Route::get('/goods','Goods\GoodsControllers@show');
Route::get('/goodsadd','Goods\GoodsControllers@showadd');
=======
<<<<<<< HEAD
<<<<<<< HEAD
Route::get('cart','Goods\UserController@cart');
=======
Route::get('/goods','Goods\GoodsControllers@show');
>>>>>>> ce0a1ecefc975b15bed798f8f7e9a8988242ed6c
=======
Route::get('/goods','Goods\GoodsControllers@show');
>>>>>>> ce0a1ecefc975b15bed798f8f7e9a8988242ed6c
>>>>>>> 363ec16f65bff8111e1e5ed3bc63bae827136b90
