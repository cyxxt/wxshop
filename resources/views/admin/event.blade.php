<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('css/weui.css')}}">
</head>
<body>
<form action="doadd" method="post" enctype="multipart/form-data">
    <div class="_div">
        <b>素材选择</b>
        <select name="type" id="type">
            <option value="text">文本</option>
            <option value="image">图片</option>
            <option value="news">图文</option>
            <option value="music">音乐</option>
            <option value="video">视频</option>
            <option value="audio">语音</option>
        </select>
        <div class="text">
            <textarea name="content" id="" cols="30" rows="10"></textarea>
        </div>
    </div>
    <input type="submit" class="weui-btn weui-btn_primary" value="提交">
</form>
</body>
</html>
<script>
    $(function(){

            $('#type').change(function(){
                var _type=$(this).val();
                console.log(_type);
                if(_type=='text'){
                    $('.text').remove();
                    $('._div').append(
                            "<div class=\"text\">\n" +
                            "            <textarea name=\"content\" id=\"\" cols=\"30\" rows=\"10\"></textarea>\n" +
                            "        </div>"
                    )
                    $('.img').remove();
                    $('.video').remove();
                    $('.audio').remove();
                    $('.music').remove();
                    $('.news').remove();
                }else if (_type=='news'){
                    $('._div').append(
                            "<div  class=\"news\">\n" +
                            "            <p>标题<input type=\"text\" name=\"title\"></p>\n" +
                            "            <textarea name=\"content\" id=\"\" cols=\"30\" rows=\"10\"></textarea>\n" +
                            "            <p>图片<input type=\"file\" name=\"img\"></p>\n" +
                            "            <p>网址<input type=\"text\" name=\"url\"></p>\n" +
                            "        </div>"
                    );
                    $('.text').remove();
                    $('.img').remove();
                    $('.video').remove();
                    $('.audio').remove();
                    $('.music').remove();
                }else if(_type=="image"){
                    $('.text').remove();
                    $('.news').remove();
                    $('.video').remove();
                    $('.audio').remove();
                    $('.music').remove();
                    $('._div').append("<div class=\"img\">\n" +
                            "            <input type=\"file\"  name=\"img\">\n" +
                            "        </div>");
                }else if(_type="video"){
                    $('._div').append("<div class=\"video\">\n" +
                            "            <input type=\"file\"  name=\"img\">\n" +
                            "        </div>");
                    $('.text').remove();
                    $('.news').remove();
                    $('.img').remove();
                    $('.audio').remove();
                    $('.music').remove();

                }else if(_type="audio"){
                    $('._div').append("<div class=\"audio\">\n" +
                            "            <input type=\"file\"  name=\"img\">\n" +
                            "        </div>");
                    $('.text').remove();
                    $('.news').remove();
                    $('.video').remove();
                    $('.img').remove();
                    $('.music').remove();

                }else if(_type="music") {
                    $('._div').append("<div class=\"music\">\n" +
                            "            <input type=\"file\"  name=\"img\">\n" +
                            "        </div>");
                    $('.text').remove();
                    $('.news').remove();
                    $('.video').remove();
                    $('.img').remove();
                    $('.audio').remove();

                }
            })
    })
</script>