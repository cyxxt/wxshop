@extends('must')

<link href="css/comm.css" rel="stylesheet" type="text/css" />
<link href="css/member.css" rel="stylesheet" type="text/css" />
<script src="js/jquery190_1.js" language="javascript" type="text/javascript"></script>
@section('content')
    <body class="g-acc-bg">

    <div class="welcome" >
        <p>Hi，等你好久了！</p>
        <a href="{{url('login/login')}}" class="orange">登录</a>
        <a href="{{url('login/registers')}}" class="orange">注册</a>
    </div>


    <!--获得的商品-->

    <!--导航菜单-->

    <div class="sub_nav marginB person-page-menu">
        <a href="/v44/member/goodsbuylist.do"><s class="m_s1"></s>潮购记录<i></i></a>
        <a href="/v44/member/orderlist.do"><s class="m_s2"></s>获得的商品<i></i></a>
        <a href="/v44/member/postlist.do"><s class="m_s3"></s>我的晒单<i></i></a>
        <a href="/v44/member/mywallet.do"><s class="m_s4"></s>我的钱包<i></i></a>
        <a href="/v44/member/mywallet.do"><s class="m_s5"></s>收货地址<i></i></a>
        <a href="/v44/help/help.do" class="mt10"><s class="m_s6"></s>帮助与反馈<i></i></a>
        <a href="/v44/help/help.do"><s class="m_s7"></s>二维码分享<i></i></a>
        <p class="colorbbb">客服热线：400-666-2110  (工作时间9:00-17:00)</p>
    </div>
    {{--底部--}}
    <div class="footer clearfix">
        <ul>
            <li class="f_home"><a href="{{url('/')}}" ><i></i>潮购</a></li>
            <li class="f_announced"><a href="{{url('allshops')}}"  ><i></i>所有商品</a></li>

            <li class="f_car"><a id="btnCart" href="{{url('shopcart')}}" ><i></i>购物车</a></li>
            <li class="f_personal"><a href="userpage" class="hover"><i></i>我的潮购</a></li>
        </ul>
    </div>
    </body>
    @endsection

<script>
    function goClick(obj, href) {
        $(obj).empty();
        location.href = href;
    }
    if (navigator.userAgent.toLowerCase().match(/MicroMessenger/i) != "micromessenger") {
        $(".m-block-header").show();
    }
</script>
