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
    public  function friendadd(Request $request){
        $id=$request->input('id');
        $arr=UserModel::where(['uid'=>$id])->first();
        $data=[
            'id'=>$arr['uid'],
            'name'     =>$arr['name'],
            'age'     =>$arr['age'],
            'email'=>$arr['email'],
            'reg_time'=>time()
        ];
        $res=FriendModel::insertGetId($data);
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
}
