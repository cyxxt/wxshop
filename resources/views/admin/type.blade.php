<!doctype html>
<html lang="0">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('css/weui.css')}}">
    <script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
</head>
<body>
    <div class="weui-cells weui-cells_radio">
    <label class="weui-cell weui-check__label" for="x11">
        <div class="weui-cell__bd">
            <p>图片</p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" class="weui-check" name="radio1" value="image" id="x11"/>
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="x12">
        <div class="weui-cell__bd">
            <p>图文</p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" class="weui-check" value="news" id="x12" />
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="x13">
        <div class="weui-cell__bd">
            <p>视频</p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" class="weui-check" value="video"  id="x13" />
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="x14">
        <div class="weui-cell__bd">
            <p>文本</p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" class="weui-check" value="text" id="x14" />
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="x15">
        <div class="weui-cell__bd">
            <p>音乐</p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" class="weui-check" value="music" id="x15" />
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="x16">
        <div class="weui-cell__bd">
            <p>语音</p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" class="weui-check" value="audio" id="x16" checked="checked"/>
            <span class="weui-icon-checked"></span>
        </div>
    </label>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('input[type="radio"]').each(function(){
            var type=$(this).val();
            var type1="{{$type}}";
            if(type==type1){
                $(this).attr('checked','checked');
            }
        })
    });


        $(document).on('click','.weui-cell__ft',function(){
            $('input[type="radio"]:checked').each(function(){
                var type=$(this).val();
                window.confirm("您选择的是"+type+"类型");
//                console.log(_val);
                $.post(
                        'typedo',
                        {type:type,_token:'{{csrf_token()}}'},
                        function(res){
                            console.log(res);
                        }
                )
        })
    })
    </script>