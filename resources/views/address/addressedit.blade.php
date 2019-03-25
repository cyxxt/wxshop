@extends('must')
    <link rel="stylesheet" href="{{url('css/writeaddr.css')}}">
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{url('dist/css/LArea.css')}}">
@section('content')
    <body>
@csrf
    <!--触屏版内页头部-->
    <div class="m-block-header" id="div-header">
        <strong id="m-title">填写收货地址</strong>
        <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
        <a href="javascript:;" class="m-index-icon" id="adddo">保存</a>
    </div>
    <div class=""></div>
    <!-- <form class="layui-form" action="">
      <input type="checkbox" name="xxx" lay-skin="switch">

    </form> -->
    <form class="layui-form" action="">
        <input type="hidden" id="address_id" value="{{$arr->address_id}}">
        <div class="addrcon">
            <ul>
                <li><em>收货人</em><input type="text" value="{{$arr->address_name}}"  id="uname" placeholder="请填写真实姓名"></li>
                <li><em>手机号码</em><input type="number" value="{{$arr->address_tel}}" id="tel" name placeholder="请输入手机号"></li>
                <li><em>所在区域</em><input id="demo1" value="{{$arr->address_szqy}}" type="text" name="input_area" placeholder="请选择所在区域">
                </li>
                <li class="addr-detail"><em>详细地址</em><input type="text" value="{{$arr->address_detail}}" id="addsc" placeholder="20个字以内" class="addr"></li>
            </ul>
            <div class="setnormal"><span>设为默认地址</span>
                @if($arr->is_default==1)
                <input type="checkbox"  id="default" name="xxx" lay-skin="switch" checked>
                @else
                    <input type="checkbox"  id="default" name="xxx" lay-skin="switch">
                @endif
            </div>
        </div>
    </form>
</div>
    </body>
    @endsection

<!-- SUI mobile -->
<script src="{{url('dist/js/LArea.js')}}"></script>
<script src="{{url('dist/js/LAreaData1.js')}}"></script>
<script src="{{url('dist/js/LAreaData2.js')}}"></script>
<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
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
    var area = new LArea();
    area.init({
        'trigger': '#demo1',//触发选择控件的文本框，同时选择完毕后name属性输出到该位置
        'valueTo':'#value1',//选择完毕后id属性输出到该位置
        'keys':{id:'id',name:'name'},//绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
        'type':1,//数据源类型
        'data':LAreaData//数据源
    });


</script>
    <script>
        $(function(){
            $("#adddo").click(function(){
                var uname=$("#uname").val();
                var tel=$("#tel").val();
                var demo=$("#demo1").val();
                var addsc=$("#addsc").val();
                var _default=$("#default").prop('checked');
                var address_id=$("#address_id").val();
//                console.log(_default);
                var is_default='';
                if(_default){
                    is_default=1;
                }else{
                    is_default=2;
                }
//                console.log(is_default);
                if(uname==''){
                    layer.msg('收获人不能为空哦');
                    return false;
                }
                if(tel==''){
                    layer.msg('手机号不能为空哦');
                    return false;
                }if(demo==''){
                    layer.msg('所在区域不能为空哦');
                    return false;
                }if(addsc==''){
                    layer.msg('详细地址不能为空哦');
                    return false;
                }
                $.post(
                        'editdo',
                        {address_id:address_id,address_name:uname,address_tel:tel,address_szqy:demo,address_detail:addsc,_token:$("[name='_token']").val(),is_default:is_default},
                        function(res){
                            console.log(res);
                            if(res==1){
                                layer.msg('保存成功');
                                location.href="addre";
                            }
                        }
                )
            })
        })
    </script>


