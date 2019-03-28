<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/3/26
 * Time: 下午 07:44
 */

namespace App\Http\Controllers\Order;
use App\Model\CartAdd;
use App\Model\CartModel;
use App\Model\GoodsModel;
use App\Model\OrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function add(Request $request)
    {
        //查询购物车商品
        $cart_id=$request->input('cart_id');
        $uid=$request->input('uid');
        //根据id查询一条数据
        $info = CartAdd::where(['cart_id' =>$cart_id])->first();
        if (empty($info)) {
            die("购物车中无商品");
        }
        //生成订单号
        $order_sn = OrderModel::Ordernumber();
        $data = [
            'order_sn' => $order_sn,
            'uid' => $uid,
            'add_time' => time(),
            'order_amount' => $info['cart_pirce']
        ];

        $oid = OrderModel::insertGetId($data);
        if ($oid) {
           $response=[
               'errno'=>0,
               'msg'  =>"订单成功"
           ];
            CartAdd::where(['cart_id'=>$cart_id])->update(['status'=>2]);
        } else {
            $response=[
                'errno'=>50001,
                'msg'  =>"订单失败"
            ];
        }
        return $response;
    }

    public function show(Request $request)
    {
        $uid=$request->input('uid');
        $data=[
            'uid'=>$uid
        ];
        $list = OrderModel::where()->get();
        return $list;
    }
}