@extends('must')
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/login.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/vccode.css')}}" rel="stylesheet" type="text/css" />
<body>
    @section('content')
<!--触屏版内页头部-->
    @csrf
<div class="m-block-header" id="div-header">
    <strong id="m-title">登录</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="home-icon"></i></a>
</div>

<div class="wrapper">
    <div class="registerCon">
        <div class="binSuccess5">
            <ul>
                <li class="accAndPwd">
                    <dl>
                        <div class="txtAccount">
                            <input id="uname" type="text" placeholder="请输入您的手机号码/邮箱"><i></i>
                        </div>
                        <cite class="passport_set" style="display: none"></cite>
                    </dl>
                    <dl>
                        <input id="pwd" type="password" placeholder="密码" value="" maxlength="20" /><b></b>
                    </dl>
                    <dl>
                        <input id="verifycode" type="text" placeholder="请输入验证码"  maxlength="4" /><b></b>
                        <img src="{{url('verify/create')}}" alt="" id="img">
                    </dl>
                </li>
            </ul>
            <a id="btn" href="javascript:;" class="orangeBtn loginBtn">登录</a>
        </div>
        <div class="forget">
            <a href="https://m.1yyg.com/v44/passport/FindPassword.do">忘记密码？</a><b></b><a href="https://m.1yyg.com/v44/passport/register.do?forward=https%3a%2f%2fm.1yyg.com%2fv44%2fmember%2f">新用户注册</a>
        </div>
    </div>
    <div class="oter_operation gray9" style="display: none;">

        <p>登录666潮人购账号后，可在微信进行以下操作：</p>
        1、查看您的潮购记录、获得商品信息、余额等<br />
        2、随时掌握最新晒单、最新揭晓动态信息
    </div>
</div>

<div class="footer clearfix" style="display:none;">
    <ul>
        <li class="f_home"><a href="/v44/index.do" ><i></i>潮购</a></li>
        <li class="f_announced"><a href="/v44/lottery/" ><i></i>最新揭晓</a></li>
        <li class="f_single"><a href="/v44/post/index.do" ><i></i>晒单</a></li>
        <li class="f_car"><a id="btnCart" href="/v44/mycart/index.do" ><i></i>购物车</a></li>
        <li class="f_personal"><a href="/v44/member/index.do" ><i></i>我的潮购</a></li>
    </ul>
</div>
</body>
@endsection
<script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
<script>
    $(function(){
        $("#btn").click(function(){
            var uname=$("#uname").val();
//            console.log(uname);
            var pwd=$("#pwd").val();
//            console.log(pwd);
            if(uname==''){
                layer.msg('用户名不能为空');
                return false;
            }
            if(pwd==''){
                layer.msg('密码不能为空');
                return false;
            }
            var code=$("#verifycode").val();
            $.post(
                    'logindo',
                    {uname:uname,pwd:pwd,_token:$("[name='_token']").val(),code:code},
                    function(res){
//                        console.log(res);
                        if(res==1){
                            layer.msg('登录成功');
                            location.href="/";
                        }
                    }
            )
        })


        $("#img").click(function(){
            $(this).attr('src',"{{url('/verify/create')}}"+"?"+Math.random())
        })
    })
</script>

