<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/css/common_a.css" rel="stylesheet" tyle="text/css"/>
    <link href="/css/style_a.css" rel="stylesheet" type="text/css"/>
    <title>用户登录</title>
</head>

<body>
<!--顶部样式-->
<div class="common_top">
    <div class="Narrow">
        <div class=" left logo"><a href="/"><img src="/images/logo.png" width="350"/></a></div>
        <!--可修改图层-->
        <div class=" left festival"><a href="#"><img src=""/></a></div>
        <!--电话图层-->
        <div class="phone"></div>
    </div>
</div>
<div class="login Narrow">
    <div class="login_advertising"><img src="/images/iStock.png" width="600"/></div>
    <div class="login_frame">
        <div class="login-form right">
            <div class="login-name"><h1 class="name">管理员登录</h1><span class="login_link"><a
                        href="/"><b></b>普通用户登录</a></span>
            </div>
            <!--提示信息-->
            @if (count($errors) > 0)
                <div class="Prompt">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="/admin/login">
                <div class="form clearfix">
                    <div class="item item-fore1"><label for="loginname" class="login-label name-label"></label>
                        <input name="id" type="text" class="text" placeholder="请输入用户"/>
                    </div>
                    <div class="item item-fore2"><label for="nloginpwd" class="login-label pwd-label"></label>
                        <input name="psd" type="password" class="text" placeholder="用户密码"/>
                    </div>
                    <div class="Forgetpass"><a href="#">忘记密码？</a></div>
                </div>
                <div class="login-btn">
                    {{csrf_field()}}
                    <input type="submit" value="登&nbsp;&nbsp;&nbsp;&nbsp;录" class="btn_login"/>
                </div>
            </form>
        </div>
    </div>
</div>
<!--底部样式-->
<div class="bottom_footer">
    <p>2020 毕业设计 基于PHP+Neo4j的在线跳蚤市场系统 </p>
</div>
</body>
</html>
