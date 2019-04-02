<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link href="css/mui.min.css" rel="stylesheet" />
    <link rel="stylesheet" href=".../public/bootstrap/css/bootstrap.min.css">

</head>

<body>

<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">Login</h1>
</header>
<div class="mui-content">
    <form id='login-form' class="mui-input-group">
        <div class="mui-input-row">
            <label>用户名</label>
            <input type="text" class="form-control" id="u_name" name="u_name" placeholder="请输入用户名">
        </div>
        <div class="mui-input-row">
            <label>密码</label>
            <input type="password" class="form-control" id="u_pwd" name="u_pwd" placeholder="请输入密码">
        </div>
    </form>
    <div class="mui-content-padded">
        <button  class="btn btn-success btn-block" onclick="reg()">登陆</button>
    </div>
</div>
</div>
</body>


<script src="js/mui.min.js"></script>
<script>
    function reg(){
        var user_name=document.getElementById('u_name').value;
        var user_pwd=document.getElementById('u_pwd').value;
        mui.ajax({
            url: 'http://shop135.qianqianya.xyz/apilogin',
            data: {u_name:user_name,u_pwd:user_pwd},
            dataType: 'json',
            type: 'post',
            success: function(data) {
                //alert(data);
                if(data.errno==0){
                    alert(data.msg);
                    //location.href="user_center.html";

                    var webview=mui.openWindow({
                        url:'user_center.html',
                        extras:{
                            uid:data.uid
                        },
                    })

                    //alert(data.token);
                }else{
                    alert('账号或密码错误，请重试！');
                    location.href="login.html";
                }

            },
            error: function(data) {
                alert('系统异常，请重试！');
                location.href="login.html";
            }

        });
    }
</script>
</html>
