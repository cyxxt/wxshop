<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>设置密码</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/login.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/findpwd.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
</head>
<body>
@csrf
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">设置密码</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>


<div class="wrapper">
    <div class="registerCon">
        <ul>
            <li>
                <s class="password"></s>
                <input type="password" id="verifcode" placeholder="6-16位数字、字母组成" value="" maxlength="26" />
                <span class="clear">x</span>
            </li>
            <li>
                <s class="password"></s>
                <input type="password" id="pwd" placeholder="确认密码" value="" maxlength="26" />
                <span class="clear">x</span>
            </li>

            <li><a id="findPasswordNextBtn" href="javascript:void(0);" class="orangeBtn">确认</a></li>
        </ul>
    </div>

</div>

<script src="{{url('layui/layui.js')}}"></script>
<script>
    layui.use(['layer', 'laypage', 'element'], function(){
        var layer = layui.layer
                ,laypage = layui.laypage
                ,element = layui.element();
    })
</script>
<script>

    function resetpwd(){
        // 密码失去焦点
        $('#verifcode').blur(function(){
            reg=/^[0-9A-Za-z]{6,16}$/;
            var that = $(this);
            if( that.val()==""|| that.val()=="6-16位数字、字母组成"){
                layer.msg('请重置密码！');
            }else if(!reg.test(that.val())){
                layer.msg('请输入6-16位数字、字母组成的密码！');
            }
        })

    }
    resetpwd();

    $('.registerCon input').bind('keydown',function(){
        var that = $(this);
        if(that.val().trim()!=""){

            that.siblings('span.clear').show();
            that.siblings('span.clear').click(function(){
                that.val("");
                $(this).hide();
            })

        }else{
            that.siblings('span.clear').hide();
        }

    })

</script>
<script>
    $(function(){
        $("#pwd").blur(function(){
            var pwd=$("#pwd").val();
//            console.log(pwd);
           var pwd1=$("#verifcode").val();
            if(pwd==''){
                layer.msg('确认密码不能为空');
                return false;
            }
            if(pwd!=pwd1){
                layer.msg('确认密码必须和密码一致');
                return false;
            }

        })

        $("#findPasswordNextBtn").click(function(){
            var pwd=$("#pwd").val();
            var pwds=$("#verifcode").val();

            $.post(
                    'registerdo',
                    {pwd:pwd,pwds:pwds,_token:$("[name='_token']").val()},
                    function(res){
//                        console.log(res);
                        if(res==1){
                            layer.msg('注册成功');
                            location.href="login";
                        }
                    }
            )
        })
    })
</script>
</body>
</html>
