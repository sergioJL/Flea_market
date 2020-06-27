<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/css/common_a.css" rel="stylesheet" tyle="text/css"/>
    <link href="/css/style_a.css" rel="stylesheet" type="text/css"/>
    <link href="/css/fonts/iconfont.css" rel="stylesheet" type="text/css"/>
    <link href="/css/Orders.css" rel="stylesheet" type="text/css"/>
    <script src="/js/admin/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="/js/admin/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
    <script src="/js/admin/common_js.js" type="text/javascript"></script>
    <script src="/js/admin/footer.js" type="text/javascript"></script>
    <script src="/js/admin/jquery.jumpto.js" type="text/javascript"></script>
    @yield('head')
    <title>Flea Market（Admin）</title>
</head>
<script type="text/javascript">
    $(document).ready(function () {

        setInterval(showTime, 1000);

        function timer(obj, txt) {
            obj.text(txt);
        }

        function showTime() {
            var today = new Date();
            var weekday = new Array(7)
            weekday[0] = "星期日"
            weekday[1] = "星期一"
            weekday[2] = "星期二"
            weekday[3] = "星期三"
            weekday[4] = "星期四"
            weekday[5] = "星期五"
            weekday[6] = "星期六"
            var y = today.getFullYear() + "年";
            var month = today.getMonth() + 1 + "月";
            var td = today.getDate();
            var d = weekday[today.getDay()];
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            timer($("#y"), y + month);
            //timer($("#MH"),month);
            timer($("h1"), td);
            timer($("#D"), d);
            timer($("#H"), h);
            timer($("#M"), m);
            timer($("#S"), s);
        }
    })
</script>
<body>
<!--内页样式-->
<div class="user_style clearfix" id="user">

    <!--用户中心布局样式-->
    <div class="left_style">
        <!--栏目名称-->
        <div class="title_username">控制中心</div>

        <div class="user_Head">
            <div class="user_time">
                <h4 id="y" class="years"></h4>
                <h1></h1>
                <h4 id="D"></h4>
            </div>
            <div class="user_portrait">
                <img src="/images/people.png"/>
                <div class="background_img"></div>
            </div>

        </div>
        <ul class="Section">
            @yield('left')
        </ul>
        <div class="title_username" style="background-color: #ff7a22;" onclick="javascript:window.location.href='/'">退   出</div>
    </div>
    <!--右侧样式布局-->
    <div class="right_style r_user_style">
        <!--地址管理-->
        @yield('right')

    </div>
</div>
</body>
</html>

