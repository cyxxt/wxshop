<html>
<head>
    <meta charset="UTF-8">
    <title>添加菜单</title>
    <link rel="stylesheet" href="{{url('/css/weui.css')}}">
</head>
<body>

<form action="/admin/menudo" method="post">
    @csrf
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">菜单名称</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text"  placeholder="请输入菜单名称" name="m_name"/>
        </div>
    </div>
    <div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">选择类型</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" name="type" id="type">
                <option value="">请选择</option>
                <option value="click">click</option>
                <option value="view">view</option>
            </select>
        </div>
    </div>
    <div class="weui-cell box">
    </div>
    <div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">选择类型</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" name="p_id">
                <option value="4">一级菜单</option>
                @foreach($menu as $v)
                    <option value="{{$v['m_id']}}">{{$v['m_name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="submit" class="weui-btn weui-btn_primary" value="添加">
</form>
</body>
</html>

<script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
<script>
    $(document).on('change','#type',function(){
        var type =  $(this).val();
        var str = '';
        if(type=='click'){
            str +='<div class="weui-cell__hd"><label class="weui-label">菜单KEY值</label></div><div class="weui-cell__bd"><input class="weui-input" type="text"  placeholder="请输入key" name="key"/></div>'
        }else if(type=='view'){
            str +='<div class="weui-cell__hd"><label class="weui-label">跳转链接</label></div><div class="weui-cell__bd"><input class="weui-input" type="text"  placeholder="请输入跳转链接" name="url"/></div>'
        }
        $(".box").html(str);
    })
</script>