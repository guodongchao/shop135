<?php

namespace App\Http\Controllers\Goods;



use App\Model\CartModel;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function cart(Request $request){
        $uid=$request->input('uid');
        $data=[
          'uid' =>$uid,
          'status'=>1
        ];
        $data = CartModel::where($data)->get();
      //  print_r($res);
        return $data;
    }
}