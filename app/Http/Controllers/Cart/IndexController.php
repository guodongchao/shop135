<?php

namespace App\Http\Controllers\Cart;

use App\Model\CartModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\GoodsModel;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public $uid;                    // 登录UID

    public function add2(Request $request)
    {
        

        //写入购物车表
        $data = [
            'goods_id'  => 2,
            'num'       => 5,
            'add_time'  => time(),
            'uid'       => 1,
            'session_token' =>1234567
        ];

        $cid = CartModel::insertGetId($data);
        if(!$cid){
            $response = [
                'errno' => 5002,
                'msg'   => '添加购物车失败，请重试'
            ];
            return $response;
        }


        $response = [
            'error' => 0,
            'msg'   => '添加成功'
        ];
        return $response;
    }

}