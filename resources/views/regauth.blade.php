<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>注册验证</title>
<meta content="app-id=984819816" name="apple-itunes-app" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta content="telephone=no" name="format-detection" />
<link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('css/login.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('css/findpwd.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
<link rel="stylesheet" href="{{url('css/modipwd.css')}}">
<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
</head>
<body>
    @csrf
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title"></strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>



    <div class="wrapper">
        <form class="layui-form" action="">
            <div class="registerCon">
                <ul>
                    <li class="auth"><em>请输入验证码</em></li>
                    <li id="tel" style="display: none"><p>我们已向<em class="red">{{$tel}}</em>发送验证码短信，请查看短信并输入验证码。</p></li>
                    <li>
                        
                        <input type="text" id="userMobile" placeholder="请输入验证码" value=""/>
                        <a href="javascript:void(0);" class="sendcode" id="btn">获取验证码</a>
                    </li>

                    <li><a id="findPasswordNextBtn" href="javascript:void(0);" class="orangeBtn">确认</a></li>
                    <li>换了手机号码或遗失？请致电客服解除绑定400-666-2110</li>
                </ul>
            </div>
        </form>
    </div>


<script src="{{url('layui/layui.js')}}"></script>
<script>
//Demo
layui.use('form', function(){
  var form = layui.form();


  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});

</script>
<script>
    $(function(){
        $("#btn").click(function(){
            var _this=$(this);
//            console.log(_this);
            var _text=_this.text();

//            console.log(tel);
            if(_text=='获取验证码'){
                _this.text(5+'s');
                $("#tel").show();
                _time=setInterval(go,1000);
            }



            //发送验证码
            $.post(
                    'codedo',
                    {_token:$("[name='_token']").val()},
                    function(res){
//                        console.log(res);
                        if(res==1){
                            layer.msg('发送成功');
                        }
                    }
            )
            function go(){
                var xt=parseInt(_this.text());
//                console.log(xt);
                if(xt=='0'){
                    _this.text('获取验证码');
                    clearInterval(_time);
                    $('#span_email').css("pointer-events","auto");
                }else{
                    xt=xt-1;
//                    console.log(xt);
                    _this.text(xt+'s');
                    $('#span_email').css("pointer-events","none");
                }
            }
        })

        $("#findPasswordNextBtn").click(function(){
            var code=$("#verifycode").val();
            $.post(
                    'registerdo',
                    {_token:$("[name='_token']").val(),code:code},
                    function(res){
//                        console.log(res);

                    }
            )
        })
    })

</script>
</body>
</html>
    