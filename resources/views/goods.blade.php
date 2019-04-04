<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}"  media="all">
    <script src="{{url('layui/layui.js')}}" charset="utf-8"></script>
    <style>
        li{list-style: none;float: left;margin-left:50px}
    </style>
</head>
<body>
{{--<div id="_div">--}}
{{--<input type="text" value="{{$search}}" id="search"><input type="button" value="搜索" id="btn"></br>--}}

    {{--@foreach($info as $v)--}}
        {{--{{$v->goods_name}}</br>--}}
        {{--@endforeach--}}
    {{--{{ $info->appends(['search' => $search])->links() }}--}}
{{--</div>--}}

{{--用户名<input type="text" id="uname"></br>--}}
{{--密码<input type="password" id="pwd"></br>--}}
{{--<input type="button" value="登录" id="btnn">--}}
{{--<a href="{{url('pw')}}">修改密码</a>--}}



<div class="layui-form-item" style="margin-left:20px ">
    <div class="layui-input-inline">
        <input type="text" name="title" id="tel" lay-verify="title"  placeholder="请输入手机号" class="layui-input">
    </div>
</div>
<div class="layui-form-item" style="margin-left:20px ">
    <div class="layui-input-inline">
        <input type="text" name="title" id="pwd" lay-verify="title"  placeholder="请输入密码" class="layui-input">
    </div>
</div>
<div class="layui-form-item" style="margin-left:20px ">
    <div class="layui-input-inline">
        <input type="text" name="title" id="code" lay-verify="title"  placeholder="请输入验证码" class="layui-input">
    </div>
</div>
<div style="width: 216px; margin-left: 20px;">
    <!-- layui 2.2.5 新增 -->
    <button class="layui-btn layui-btn-fluid">重  置</button><button class="layui-btn layui-btn-fluid" style="margin-left:54px ">登      录</button>
</div>
<div style="width: 216px; margin-left: 20px;margin-top: 20px;">
    <a>忘记密码</a><a style="margin-left:45px ">没有账号？去注册</a>
</div>
</body>
</html>
<script>
    $(function () {
        {{--$("#btn").click(function () {--}}
            {{--var search=$("#search").val();--}}
{{--//            console.log(search);--}}
            {{--$.post(--}}
                 {{--'goods',--}}
                    {{--{search:search,_token:'{{csrf_token()}}'},--}}
                    {{--function(res){--}}
{{--//                        console.log(res);--}}
                        {{--$("#_div").html(res);--}}
                    {{--}--}}
            {{--)--}}
        {{--})--}}

        {{--$("#btnn").click(function(){--}}
            {{--var uname=$("#uname").val();--}}
            {{--var pwd=$("#pwd").val();--}}
            {{--$.post(--}}
                    {{--'logindo',--}}
                    {{--{uname:uname,pwd:pwd,_token:'{{csrf_token()}}'},--}}
                    {{--function(res){--}}
                        {{--console.log(res);--}}
                    {{--}--}}
            {{--)--}}
        {{--})--}}


    })
</script>