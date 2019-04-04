<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="{{'/js/jquery-1.8.3.min.js'}}"></script>
    <script src="{{'/layui/layui.js'}}"></script>
</head>
<body>
用户名：<input type="text" name="user_name" id="user_name"></br>
密码：<input type="password" name="user_pwd" id="user_pwd"></br>
确认密码：<input type="password" name="user_pwd1" id="user_pwd1"></br>
<input type="text" name="code" id="code"><input type="button" id="bun" value="获取验证码"></br>
<input type="button" value="注册" id="btn">
</body>
</html>
<script>
    $(function(){
        layui.use('layer',function(){
            var layer=layui.layer;
            $("#btn").click(function(){
                var  user_name=$("#user_name").val();
                var  user_pwd=$("#user_pwd").val();
                var  user_pwd1=$("#user_pwd1").val();
                var  code=$("#code").val();
                
                if(user_name==''){
                    layer.msg('用户名不能为空');
                    return false;
                }
                if(user_pwd==''){
                    layer.msg('密码不能为空');
                    return false;
                }
                if(user_pwd!=user_pwd1){
                    layer.msg('密码和确认密码必须一致');
                    return false;
                }


                $.post(
                        'registerdo',
                        {user_name:user_name,user_pwd:user_pwd,code:code,_token:"{{csrf_token()}}"},
                        function(res){
//                            console.log(res);
                            if(res==1){
                                layer.msg('注册成功');
                                location.href="login";
                            }
                        }
                )
            })
        });



        //获取验证码
        $("#bun").click(function(){
            var  user_name=$("#user_name").val();
            $.post(
                    'codedo',
                    {user_name:user_name,_token:"{{csrf_token()}}"},
                    function(res){
                        console.log(res);
                    }
            )
        })

    })
</script>