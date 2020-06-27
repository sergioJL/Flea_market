<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link type="text/css" rel="stylesheet" href="/css/style.css"/>
    <!--[if IE 6]>
    <script src="/js/iepng.js" type="text/javascript"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a');
    </script>
    <![endif]-->
    <script type="text/javascript" src="/js/jquery-1.11.1.min_044d0927.js"></script>
    <script type="text/javascript" src="/js/jquery.bxslider_e88acd1b.js"></script>

    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>

    <script type="text/javascript" src="/js/select.js"></script>

    <script type="text/javascript" src="/js/lrscroll.js"></script>

    <script type="text/javascript" src="/js/iban.js"></script>
    <script type="text/javascript" src="/js/fban.js"></script>
    <script type="text/javascript" src="/js/f_ban.js"></script>
    <script type="text/javascript" src="/js/mban.js"></script>
    <script type="text/javascript" src="/js/bban.js"></script>
    <script type="text/javascript" src="/js/hban.js"></script>
    <script type="text/javascript" src="/js/tban.js"></script>
    <script type="text/javascript" src="/js/sban.js"></script>
    <script type="text/javascript" src="/js/eban.js"></script>
    <script type="text/javascript" src="/js/nban.js"></script>

    <script type="text/javascript" src="/js/lrscroll_1.js"></script>
    @yield('head')

    <title>Flea Market</title>
    <style type="text/css">
        input {
            border-style: none;

        }

        .prod {
            float: left;
            width: 205px;
            margin-left: 20px;
        }

        img {
            transition: all 0.6s;
            border-radius: 5%;
        }

        img:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<!--Begin Header Begin-->
<div class="soubg">
    <div class="sou">
        <span class="fr">
        	<span class="fl">
                @if(session()->has('nickName'))
                    你好，{!! session('nickName') !!} <a href="/user/logout">退出</a> <a href="/user/all">个人中心</a>
                @else
                    你好，请<a href="/user/login">登录</a>&nbsp; <a href="/user/register" style="color:#ff4e00;">免费注册</a>
                @endif
                |&nbsp;<a href="/user/allMessageReply">消息回复<font id='xx_num' style="background-color: #ff3200;color: #FFFFFF; border-radius:25px; font-weight: bold;"></font></a>&nbsp;</span>
            <span class="ss">
            	<div class="ss_list_ilike"><a href="/user/Iwanted">我的收藏</a></div>
                <div class="ss_list_ilike"><a href="tencent://AddContact/?fromId=45&fromSubId=1&subcmd=all&uin=1192369119&website=www.oicqzone.com">联系客服</a></div>
                <div class="ss_list_ilike"><a href="/help">网站导航</a></div>
            </span>
        </span>
    </div>
</div>
<div class="top">
    <div class="logo"><a href="/product/showall"><img src="/images/logo.png" width="200px"/></a></div>
    <div class="search">
        <form action="/product/search" method="get">
            <input type="text" name="search" value="" class="s_ipt"/>
            <input type="submit" value="搜索" class="s_btn"/>
        </form>
        <span class="fl"><a href="/product/search?search=手机">手机</a><a href="/product/search?search=iphone 6S">iphone 6S</a><a href="/product/search?search=球鞋">球鞋</a><a href="/product/search?search=日用品">日用品</a><a
                href="#">连衣裙</a></span>
    </div>
    <div class="i_car">
        <div class="car_t"><a href="/user/Iwanted"> 我的收藏 [ <span>{{ $ilikes }}</span> ]</a></div>
    </div>
</div>
<!--End Header End-->
<!--Begin Menu Begin-->
<div class="menu_bg">
    <div class="menu">
        <!--Begin 商品分类详情 Begin-->
        <div class="nav">
        </div>
        <!--End 商品分类详情 End-->
        <ul class="menu_r">
            <li><a href="/product/showall">首页</a></li>
            <li><a href="/product/search?search=手机">手机</a></li>
            <li><a href="/product/search?search=电脑">电脑</a></li>
            <li><a href="/product/search?search=鞋包">鞋包</a></li>
            <li><a href="/product/search?search=女装">女装</a></li>
            <li><a href="/product/search?search=美妆">美妆</a></li>
            <li><a href="/product/search?search=图书">图书</a></li>
            <li><a href="/product/search?search=百货">百货</a></li>
        </ul>
        <div style="float: right;"><a href="/product/showfind"><font color="#a52a2a">求 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  购</font></a></div>
    </div>
</div>
<!--End Menu End-->
<div class="i_bg bg_color">
@yield('main')
<!--Begin Footer Begin -->
    <div class="btmbg">
        <div class="btm">
            2020 毕业设计 基于PHP+Neo4j的在线跳蚤市场系统 <br/>
        </div>
    </div>
    <!--End Footer End -->
</div>

</body>

@if(session()->has('user_id'))
    <script type="text/javascript">
        function test() {
            alert('ok');
        }
        function getxx_num() {
            $.get('/getUnreadMessage', function(response) {
                // handle your response here
                if (response!=0)
                {
                    document.getElementById('xx_num').innerHTML=response;
                }
                console.log(response);
            })
        }
        setInterval("getxx_num()",5000);
    </script>
@endif

<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
</html>
