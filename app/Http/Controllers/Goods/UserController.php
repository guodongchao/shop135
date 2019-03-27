<?php

namespace App\Http\Controllers\Goods;



use App\Model\CartModel;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function cart(){
        $data = CartModel::get();
        $res = json_encode($data);
      //  print_r($res);
        return $res;
    }
}