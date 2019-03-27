<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 19:33
 */

namespace App\Http\Controllers\Goods;
use App\Model\GoodsModel;

class GoodsControllers
{
    public function show(){
        $info=GoodsModel::get();
        return $info;
    }
}