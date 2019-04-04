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
<input type="button" value="登录" id="btn">
</body>
</html>
<script>
    $(function(){
        $("#btn").click(function(){
            layui.use('layer',function(){
                var user_name=$('#user_name').val();
                var user_pwd=$("#user_pwd").val();
                if(user_name==''){
                    layer.msg('用户名不能为空');
                    return false;
                }
                if(user_pwd==''){
                    layer.msg('密码不能为空');
                    return false;
                }
                $.post(
                        'logindo',
                        {user_name:user_name,user_pwd:user_pwd,_token:"{{csrf_token()}}"},
                        function(res){
//                            console.log(res);
                            if(res==1){
                                layer.msg('用户名有误');

                            }else if(res==2){
                                layer.msg('密码有误');

                            }else if(res==3){
                                layer.msg('登录成功');
                                location.href="list";
                            }
                        }
                )
            })
            })

    })
</script>