<?php
namespace App\Http\Controllers\Friend;
use App\Model\FriendModel;
use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function del(Request $request){
        $id=$request->input('id');
        $info = FriendModel::where(['id' =>$id])->del();
        if ($info == true){
            return '删除成功';
        }else{
            return '删除失败';
        }
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
                'error'=>0,
                'msg'   =>'好友不存在'
            ];
        }
        return $info;
    }
}