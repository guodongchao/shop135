<?php
namespace App\Http\Controllers\Friend;
use App\Model\FriendModel;
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
}