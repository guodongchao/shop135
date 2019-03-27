<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 19:33
 */

namespace App\Http\Controllers\Goods;
use App\Model\GoodsModel;
use Illuminate\Http\Request;
class GoodsControllers
{
    public function show(){
        $info=GoodsModel::get();
        return $info;
    }
    public function showadd(Request $request){
        $id=$request->input('id');
        echo $id;
        $data=[
            'goods_id'=>$id
        ];
        $info=GoodsModel::where($data)->get();
        return $info;
    }
}