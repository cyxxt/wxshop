<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h4>欢迎{{$tel}}看</h4>
    <table>
        <tr>
            <td>用户名</td>
        </tr>
        @foreach($arr as $v)
        <tr>
            <td>{{$v->user_tel}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>