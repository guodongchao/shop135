<?php



namespace App\Http\Controllers\Index;



use App\Model\UserModel;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redis;


class IndexController extends Controller

{

//手机端登录页面
    public function alogin()
    {
        $recurl = $_GET["recurl"] ?? env("SHOP_URL");

        $info = [
            "redirect" => $recurl
        ];
        return view("test.login", $info);
    }


    /**
     *移动端登录处理页面
     */
    public function apilogins(Request $request)

    {

        $name = $request->input('u_name');

        $password = $request->input('u_pwd');
        //echo $password;exit;
        //$redirect = urldecode($request->input('redirect')) ?? env('SHOP_URL');

        $where = [

            'name' => $name

        ];

        $userInfo = UserModel::where($where)->first();

        if (empty($userInfo)) {

            $response = [

                'errno' => 40001,

                'msg' => '用户名不存在'

            ];

            return $response;

        }

        $pas = $userInfo->pass;
        $xnn_uid = $userInfo->uid;
        if (password_verify($password, $pas)) {
            $uid = $userInfo->uid;
            $key = 'token:' . $uid;
            $token = Redis::get($key);
            if (empty($token)) {
                $token = substr(md5(time() + $uid + rand(1000, 9999)), 10, 20);
                //  Redis::set($key,$token);
                //   Redis::setTimeout($key,60*60*24*7);
                Redis::del($key);
                Redis::hSet($key, 'web', $token);
                //  var_dump($token);exit;
            }
            setcookie('xnn_uid', $uid, time() + 86400, '/', 'qianqianya.xyz', false, true);
            setcookie('xnn_token', $token, time() + 86400, '/', 'qianqianya.xyz', false, true);
            $request->session()->put('xnn_u_token', $token);
            $request->session()->put('xnn_uid', $uid);
            $response = [
                'errno' => 0,
                'msg' => '登陆成功',
                'uid' => $xnn_uid,
            ];
        } else {
            $response = [
                'errno' => 40002,
                'msg' => '登录失败'
            ];
        }
        //   print_r($response);exit;
        return $response;

    }

}