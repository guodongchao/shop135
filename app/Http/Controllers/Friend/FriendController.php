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
        print_r($info);exit;
        if (empty($info)) {
            $response=[
                'errno'=>50001,
                'msg'  =>"暂无好友"
            ];
            return $response;
        }
        return $info;
    }
}