<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/1/10
 * Time: 下午 02:40
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    public $table = 'p_orders';
    public $timestamps = false;
    public  static function Ordernumber(){
        return date('ymdHi').rand(1,999999).rand(25466,999999);
    }
    /**
     * 生成订单号
     */
    public static function generateOrderSN()
    {
        return date('ymdH') . rand(11111,99999) . rand(2222,9999);
    }
}