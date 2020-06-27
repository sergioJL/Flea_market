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
    <script type="text/javascript" src="/js/menu.js"></script>

    <script type="text/javascript" src="/js/select.js"></script>

    <script type="text/javascript" src="/js/lrscroll.js"></script>

    <script type="text/javascript" src="/js/iban.js"></script>
    <script type="text/javascript" src="/js/fban.js"></script>
    <script type="text/javascript" src="/js/f_ban.js"></script>
    <script type="text/javascript" src="/js/mban.js"></script>
    <script type="text/javascript" src="/js/bban.js"></script>
    <script type="text/javascript" src="/js/hban.js"></script>
    <script type="text/javascript" src="/js/tban.js"></script>

    <script type="text/javascript" src="/js/lrscroll_1.js"></script>


    <title>淘 好货</title>
</head>
<body>
<!--Begin Header Begin-->
<div class="soubg">
    <div class="sou">
        <span class="fr">
        	<span class="fl">您好，请<a href="/user/login">登录</a>&nbsp; <a href="/user/register" style="color:#ff4e00;">免费注册</a>&nbsp; <a href="/admin/login">管理员登录</a> </span>
        </span>
    </div>
</div>
<!--End Header End-->
{{--@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif--}}
<!--Begin Login Begin-->
<div class="log_bg">
    <div class="top">
        <div class="logo"><a href="/product/showall"><img src="/images/logo.png" width="200px" height="55"/></a></div>
    </div>
    <div class="login">
        <div class="log_img"><img src="/images/iStock.png" width="611" height="425"/></div>
        <div class="log_c">
            <form action=" " method="post">
                <table border="0" style="width:370px; font-size:14px; margin-top:30px;" cellspacing="0" cellpadding="0">
                    <tr height="40" valign="top">
                        <td width="20">&nbsp;</td>
                        <td>
                            <span class="fl" style="font-size:24px;">登录</span>
{{--                            {{ action('User\UserVerification@register') }}--}}
                            <span class="fr">还没有商城账号，<a href="/user/register"
                                                        style="color:#ff4e00;">立即注册</a></span>
                        </td>
                        <td width="25">&nbsp;</td>
                    </tr>
                    <tr height="65">
                        <td></td>
                        <td>
                            <input type="text" name="student_id"
                                @if(!empty(old('student_id') ))
                                    value="{{old('student_id') }}"
                                @else
                                   value="{{Request::get('student_id')}}"
                                @endif
                                 class="l_user" placeholder="学    号"/>
                            <span class="warning_sid"
                                  style="color: #ff0000;font-size: 9px;">{{ $errors->first('student_id') }}</span>
                        </td>
                    </tr>
                    <tr height="65">
                        <td></td>
                        <td>
                            <input type="password" name="psd" id="psd" value="" class="l_pwd" placeholder="密    码"/>
                            <span class="warning_psd"
                                  style="color: #ff0000;font-size: 9px;">{{ $errors->first('psd') }}</span>
                        </td>
                    </tr>
                    <tr height="65">
                        <td></td>
                        <td><input type="text" name="captcha" class="l_captcha" value="" placeholder="验证码">
                            <img src="{{captcha_src()}}" alt="" class="l_captcha_img"
                                 onclick="this.src='{{ url('captcha/default') }}?s='+Math.random()"/>
                            <span style="color: #ff0000;font-size: 9px;">{{ $errors->first('captcha') }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td style="font-size:12px; padding-top:20px;">
                	<span style="font-family:'宋体';" class="fl">
{{--                    	<label class="r_rad"><input type="checkbox"/></label><label class="r_txt">请保存我这次的登录信息</label>--}}
                    </span>
                            <span class="fr"><a href="#" style="color:#ff4e00;">忘记密码</a></span>
                        </td>
                    </tr>
                    <tr height="60">
                        <td>&nbsp;</td>
                        <td><input type="submit" value="登录" class="log_btn"/></td>
                    </tr>
                </table>
                {{csrf_field()}}
            </form>
        </div>
    </div>
</div>
<!--End Login End-->
<!--Begin Footer Begin-->
<div class="btmbg">
    <div class="btm">
        2020 毕业设计 基于PHP+Neo4j的在线跳蚤市场系统 <br/>
    </div>
</div>
<!--End Footer End -->

</body>

<!--[if IE 6]>
<script src="/js/zh_CN.js"></script>
<![endif]-->
</html>
