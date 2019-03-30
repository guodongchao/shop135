<?php
namespace App\Http\Controllers\Order;
use App\Model\CartAdd;
use App\Model\CartModel;
use App\Model\GoodsModel;
use App\Model\OrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    /*
     * 删除过期订单
     */
    public function index(){
        //当前时间
        $time=time();
        //查询所有订单
        $info=OrderModel::get();

        foreach($info as $v){
            if($time-$v['add_time']>120){
                $data[]=$v['oid'];

            }
        }
       foreach ($data as $k=>$v){
           $res=OrderModel::where(['oid'=>$v])->update(['status'=>8]);
       }
        if($res){
            return 'OK';
        }else{
            return 'NO';
        }
    }
}