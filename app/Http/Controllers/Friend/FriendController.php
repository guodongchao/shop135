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
        if ($info == true){
            return '删除成功';
        }else{
            return '删除失败';
        }
    }
}