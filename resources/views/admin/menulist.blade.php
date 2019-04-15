<html>
<head>
    <meta charset="UTF-8">
    <title>菜单列表</title>
    <link rel="stylesheet" href="{{url('/css/weui.css')}}">
    <script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
</head>
<body>
@foreach($menu as $value)
    @if($value->p_id==4)
        <div class="weui-cell menu" menuid="{{$value->m_id}}">
            <div class="weui-cell__bd">
                <p>一级菜单</p>
            </div>
            <div class="weui-cell__ft">{{$value->m_name}}</div>
            <div class="weui-cell__ft" style="margin-right: 30%">{{$value->type}}</div>
            <div class="weui-cell__ft sub_menu">
                <a href="/admin/upmenu/{{$value->m_id}}" class="weui-btn weui-btn_mini weui-btn_primary">修改</a>
                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_warn" id="forbidden" mid="{{$value->m_id}}">禁用</a>
            </div>

        </div>
    @endif
@endforeach

</body>
</html>

<script>
    $(document).ready(function(){
        $(".menu").each(function(){
            var menuid =  $(this).attr('menuid');
//             console.log(menuid);
            var that = $(this);
            $.post(
                '/admin/getmenu/',
                {menuid:menuid,_token:'{{csrf_token()}}'},
                function(res){
//                console.log(res);
                var str = '';
                for(var i in res){
                    str += '<div class="weui-cell" style="margin-left: 10%"><div class="weui-cell_bd"><p>二级菜单</p></div><div class="weui-cell_ft">'+res[i]['m_name']+'</div><div calss="weui_ft">'+res[i]['type']+'</div></div>';
                }
//                    console.log(str);
                that.after(str);
                },
                    'json'
            )

        })
    })

</script>
