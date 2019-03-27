<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/3/26
 * Time: 下午 07:44
 */

namespace App\Http\Controllers\Goods;
use App\Model\CartModel;
use App\Model\GoodsModel;
use App\Model\OrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function add(Request $request)
    {
        //查询购物车商品
        $goods_id=3;
        $goods = CartModel::where(['goods_id' =>$goods_id])->first();
        if (empty($cart_goods)) {
            die("购物车中无商品");
        }
        //生成订单号
        $order_sn = OrderModel::Ordernumber();
        $data = [
            'order_sn' => $order_sn,
            'uid' => session()->get('uid'),
            'add_time' => time(),
            'order_amount' => $goods['price']
        ];

        $oid = OrderModel::insertGetId($data);
        if (!$oid) {
            echo '生成订单失败';
        } else {
            header('Refresh:2;url=show');
            echo '下单成功,订单号：' . $oid . ' 跳转支付';
        }
    }

    public function show()
    {
        $list = OrderModel::all();
        return $list;
    }
}