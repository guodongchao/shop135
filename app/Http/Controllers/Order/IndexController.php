<?php
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
            $response=[
                'errno'=>50001,
                'msg'  =>"购物车已无次商品"
            ];
            return $response;
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
            'uid' =>$uid,
            'status' =>1
        ];
        $list = OrderModel::where($data)->get();
        return $list;
    }
}