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

    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
    {{--    <script type="text/javascript" src="/js/menu.js"></script>--}}

    <script type="text/javascript" src="/js/select.js"></script>

    @yield('head')
    <title>淘 好货</title>
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
            </span>
        	<span class="ss_a">
                <div class="ss_list">
                	<a href="#">客户服务</a>
                    <div class="ss_list_bg">
                    	<div class="s_city_t"></div>
                        <div class="ss_list_c">
                        	<ul>
                            	<li><a href="/help">获取帮助</a></li>
                                <li><a href="/user/notice">系统公告</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="ss_list">
                	<a href="#">用户切换</a>
                    <div class="ss_list_bg">
                    	<div class="s_city_t"></div>
                        <div class="ss_list_c">
                        	<ul>
                            	<li><a href="/">普通用户</a></li>
                                <li><a href="/admin/login">管理员</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </span>
      </span>
    </div>
</div>
<div class="m_top_bg">
    <div class="top">
        <div class="m_logo"><a href="/product/showall"><img src="/images/logo.png" width="300"/></a></div>
        <div class="m_search">
            <span></span>
        </div>
    </div>
</div>
<!--End Header End-->
<div class="i_bg bg_color">
    <!--Begin 用户中心 Begin -->
    <div class="m_content">
        <div class="m_left">
            <div class="left_n">管理中心</div>
            <div class="left_m">
                <div class="left_m_t t_bg2">个人中心</div>
                <ul>
                    <li><a href="/user/all">用户信息</a></li>
                    <li><a href="/user/allMesaages">我的留言</a></li>
                    <li><a href="/user/allMessageReply">我的回复</a></li>
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg5">我的收藏</div>
                <ul>
                    <li><a href="/user/Iwanted">我的收藏</a></li>
{{--                    <li><a href="/user/Iwatneddel">下架物品</a></li>--}}
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg1">寻求好货</div>
                <ul>
                    <li><a href="/user/Ifinded">我的求购</a></li>
                    <li><a href="/user/IfindProduct">发布需求</a></li>
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg3">我的物品</div>
                <ul>
                    <li><a href="/user/myproducts">我的出售</a></li>
{{--                    <li><a href="#">下架物品</a></li>--}}
                    <li><a href="/product/add">发布好货</a></li>
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg6">账户中心</div>
                <ul>
                    <li><a href="/user/safe">账户安全</a></li>
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg6">本站导航</div>
                <ul>
                    <li><a href="/user/notice">站内公告</a></li>
                    <li><a href="/help">获取帮助</a></li>
                </ul>
            </div>
            <div class="left_n"><a href="/product/showall" style="color:#f0f0f0;">返回首页</a></div>
        </div>
        <div class="m_right">
            @yield('main')
        </div>
    </div>
    <!--End 用户中心 End-->
    <!--Begin Footer Begin -->
    <div class="btmbg">
        <div class="btm">
            2020 毕业设计 基于PHP+Neo4j的在线跳蚤市场系统 <br/>
        </div>
    </div>
    <!--End Footer End -->
</div>

</body>


<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
</html>
