<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
</head>
<body>
    旧密码：<input type="password" id="pwd3"></br>
    密码：<input type="password" id="pwd1"></br>
    确认密码：<input type="password" id="pwd2"></br>
    <input type="button" value="确认修改" id="btn">
</body>
</html>
<script>
    $(function () {
        $("#btn").click(function () {
            var pwd1=$("#pwd1").val();
            var pwd2=$("#pwd2").val();
            var pwd3=$("#pwd3").val();
            $.post(
                    'pwdo',
                    {pwd1:pwd1,pwd2:pwd2,_token:'{{csrf_token()}}',pwd3:pwd3},
                    function(res){
                        console.log(res);
                    }
            )
        })
    })
</script>