<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 19:33
 */

namespace App\Http\Controllers\Goods;
use App\Model\GoodsModel;
use App\Model\CartAdd;
use Illuminate\Http\Request;
class GoodsControllers
{
    public function show(){
        $info=GoodsModel::get();
        return $info;
    }
    public function showadd(Request $request){
        $id=$request->input('id');

        $data=[
            'goods_id'=>$id
        ];
        $info=GoodsModel::where($data)->get();
        return $info;
    }

    public function cartadd(Request $request){
        $goods_id=$request->input('id');
        $info=GoodsModel::where(['goods_id'=>$goods_id])->first();
        $data=[
          'cart_name'=>$info['goods_name'],
          'uid'     =>setcookie('xnn_uid'),
          'cart_num'     =>1,
          'token'=>setcookie('xnn_token'),
          'add_time'=>time(),
          'cart_pirce'
        ];
        $res=CartAdd::insertGetId($data);
        if($res){
            $response=[
                'errno'=>0,
                'msg'  =>"添加成功"
            ];
        }else{
            $response=[
                'errno'=>50001,
                'msg'  =>"添加失败"
            ];
        }
        return $response;
    }
}