<?php
namespace App\Http\Controllers\Friend;
use foo\bar;
use App\Model\FriendModel;
use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class FriendController extends Controller
{
    public function show(Request $request){
        $uid=$request->input('uid');
        $info = FriendModel::where(['uid' =>$uid])->get();
        if (empty($info)) {
            $response=[
                'errno'=>50001,
                'msg'  =>"暂无好友"
            ];
            return $response;
        }
        return $info;
    }

    public function addFirend(Request $request)
    {
        //查看用户id
        $u_id = $request->input('u_id');
        //登录id
        $uid = $request->input('uid');
        $key = 'set:firend:'.$uid;
        $rs=Redis::zadd($key,time(),$u_id);
        if($rs){
            $response = [
                'error' =>  0,
                'msg'   =>  '添加好友成功'
            ];
        }else{
            $response = [
                'error' =>  66668,
                'msg'   =>  '您已添加他为好友,请勿重复添加'
            ];
        }
        return $response;
    }

    public function delete(Request $request){

        $id=$request->input('id');
        $info = FriendModel::where(['id' =>$id])->delete();
        if ($info){
            $response=[
                'errno'=>0,
                'msg'  =>"删除成功"
            ];
        }else{
            $response=[
                'errno'=>50002,
                'msg'  =>"删除失败"
            ];
        }
        return $response;
    }
    public function homePage(Request $request)
    {
        //查看用户id
        $u_id = $request->input('u_id');
        //登录id
        $uid = $request->input('uid');
        if($uid == $u_id){
            return [
                'error' =>  66667,
                'msg'   =>  '本人查看本人空间',
            ];
        }
        //u_id 信息
        $uu_info = FriendModel::where(['uid'=>$u_id])->first();
        //本人好友id
        $key = 'set:firend:'.$uid;
        $uu_id = Redis::zrange($key,0,-1);
        //查看用户好友id
        $u_key = 'set:firend:'.$u_id;
        $look_uid = Redis::zrange($u_key,0,-1);
        if(empty($uu_id) || empty($look_uid)){
            $common_info = [
                'error'     =>  66668,
                'msg'       =>  '您与改用户没有共同好友'
            ];
        }else{
            foreach($uu_id as $v){
                foreach($look_uid as $value){
                    if($v == $value){
                        $data = FriendModel::where(['uid'=>$v])->first();
                        $common_info[] = $data;
                    }
                }
            }
        }
        $info = [
            'u_info'    =>  $uu_info,
            'common'    =>  $common_info
        ];
        return $info;
    }

    public function friendshow(Request $request){
        $u_name=$request->input('u_name');
        $arr=UserModel::where(['name'=>$u_name])->first();

        if($arr){
            $info=[
                'error'=>0,
                'msg'   =>$arr
            ];
        }else{
            $info=[
                'error'=>50001,
                'msg'   =>'好友不存在'
            ];
        }
        return $info;
    }
}