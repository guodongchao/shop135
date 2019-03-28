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
use Illuminate\Support\Facades\Redis;
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
    /**
    *加入购物车
     */
    public function cartadd(Request $request){
        $goods_id=$request->input('id');
        $uid=$request->input('uid');
        $info=GoodsModel::where(['goods_id'=>$goods_id])->first();


        $data=[
          'cart_name'=>$info['goods_name'],
          'uid'     =>$uid,
          'cart_num'     =>1,
          'token'=>setcookie('xnn_token'),
          'add_time'=>time(),
          'cart_pirce'=>$info['price']
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
    /**
     * 点赞
     */
    public function cartadd2(Request $request){
        $id=$request->input('id');
        $where = [

            'goods_id'  =>  $id,

        ];

        $key = 'set:goods_click:'.$id;

        Redis::zadd($key,time(),time());



        $goods_key = 'str:goods_detail:'.$id;

        $data = Redis::get($goods_key);

        if(empty($data)){

            $info = GoodsModel::where($where)->first();

            Redis::set($goods_key,json_encode($info));

            Redis::expire($goods_key,60*60*3);



        }else{

            $info = json_decode($data,true);

        }

        $res= Redis::zCard($key);
        $info=[
          'erron'   =>2,
          'msg'     =>'点赞成功',
          'click'   =>$res
        ];
        return $info;

    }

    /*
     * 收藏
     */
    public function cartadd3(Request $request){
        $uid = $request->input('uid');
        //$uid = 1;
        $goods_id = $request->input('id');
        //$goods_id = 11;
        $key = 'sets:goods_fav:'.$uid;
        $rs = Redis::zrange($key,0,-1);
        foreach($rs as $k=>$v){
            if($v==$goods_id){
                return [
                    'erron' =>  522200,
                    'msg'   =>  '请勿重复收藏'
                ];
            }
        }
        $rs = Redis::zAdd($key,time(),$goods_id);
        if($rs){
            return [
                'erron' =>  3,
                'msg'   =>  '收藏成功'
            ];
        }else{
            return [
                'erron' =>  522201,
                'msg'   =>  '收藏失败'
            ];
        }

    }

    public function cartadd4(Request $request){
        $uid = $request->input('uid');
        $key = 'sets:goods_fav:'.$uid;
        $rs = Redis::zrange($key,0,-1);
        $aa=implode($rs,"','");
        $aaa= "'.$aa.'";
        echo $aaa;exit;
        $where = [
            'goods_id' =>[$aaa]
        ];
        $res = GoodsModel::where($where)->get();
        return $res;
    }

}
