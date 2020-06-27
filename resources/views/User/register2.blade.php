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


    <title>尤洪</title>
</head>
<body>
<!--Begin Header Begin-->
<div class="soubg">
    <div class="sou">
        <span class="fr">
        	<span class="fl">您好，请<a href="/user/login" style="color:#ff4e00;">登录</a></span>
        </span>
    </div>
</div>
<!--End Header End-->
<!--Begin Login Begin-->
<div class="log_bg">
    <div class="top">
        <div class="logo"><a href="Index.html"><img src="/images/logo.png" width="200px" height="55"/></a></div>
    </div>
    <div class="regist">
        <div class="log_img"><img src="/images/iStock.png" width="611" height="425"/></div>
        <div class="reg_c">
            <form method='get' action=" " id="user_form" name="user_form">
                <table border="0" style="width:420px; font-size:14px; margin-top:20px;" cellspacing="0" cellpadding="0">
                    <tr height="50" valign="top">
                        <td width="85">&nbsp;</td>
                        <td>
                            <span class="fl" style="font-size:24px;">注册</span>
                            <span class="fr">已有账号，<a href="/user/login" style="color:#ff4e00;">我要登录</a></span>
                        </td>
                    </tr>
                    <tr height="50">
                        <td align="right"><font color="#ff4e00">*</font>&nbsp;学号 &nbsp;</td>
                        <td><input type="text" name="student_id" value="{{ old('student_id') }}" class="l_user"/></td>
                    </tr>
                    <tr height="50">
                        <td align="right"><font color="#ff4e00">*</font>&nbsp;姓名 &nbsp;</td>
                        <td><input type="text" name="name" value="{{ old('name') }}" class="l_user"/></td>
                    </tr>
                    <tr height="50">
                        <td align="right"><font color="#ff4e00">*</font>&nbsp;昵称 &nbsp;</td>
                        <td><input type="text" name="nickname" value="{{ old('nickname') }}" class="l_user"/></td>
                    </tr>
                    <tr height="50">
                        <td align="right"><font color="#ff4e00">*</font>&nbsp;密码 &nbsp;</td>
                        <td><input type="password" name="psd" value="" class="l_pwd"/></td>
                    </tr>
                    <tr height="50">
                        <td align="right"><font color="#ff4e00">*</font>&nbsp;确认密码 &nbsp;</td>
                        <td><input type="password" name="psd_confirm" value="" class="l_pwd"/></td>
                    </tr>

                    <tr height="90">
                        <td align="right"><font color="#ff4e00">*</font>&nbsp;学院/专业 &nbsp; <br/><br/></td>
                        <td>
                            <select name="college" id="college" class="l_select" onchange="getprofession()">
                                <option value="0" size="10">请 选 择 学 院</option>
                            </select>
                            <select name="profession" class="l_select">
                                <option value="0">请 选 择 专 业</option>
                            </select>
                        </td>
                    </tr>
                    <tr height="50">
                        <td align="right"><font color="#ff4e00">*</font>&nbsp;入学年份 &nbsp;</td>
                        <td><input type="date" class="l_year" name="start_year" value={{date(now())}}></td>
                    </tr>
                    <tr height="50">
                        <td align="right"><font color="#ff4e00">*</font>&nbsp;手机 &nbsp;</td>
                        <td><input type="text" value="" name="phone_num" class="l_tel"/></td>
                    </tr>
                    <tr height="50">
                        <td align="right"><font color="#ff4e00">*</font>&nbsp;验证码 &nbsp;</td>
                        <td>
                            <input type="text" name="phone_yzm" value="" class="l_ipt"/>
                            <a href="javascript:" id="yzm" onclick="sendCode();"
                               style="font-size:14px; font-family:'宋体';">&nbsp;&nbsp;&nbsp;获取验证码</a>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td style="font-size:12px; padding-top:20px;">
                	<span style="font-family:'宋体';" class="fl">
                    	<label class="r_rad"><input type="checkbox"/></label><label class="r_txt">我已阅读并接受《用户协议》</label>
                    </span>
                        </td>
                    </tr>
                    <tr height="60">
                        {{csrf_field()}}
                        <td>&nbsp;</td>
                        <td><input type="submit" value="立即注册" class="log_btn"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--End Login End-->
<!--Begin Footer Begin-->
<div class="btmbg">
    <div class="btm">
        备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical
        Support: Dgg Group <br/>
    </div>
</div>
<!--End Footer End -->
<!-- 下拉框 -->
<script type="text/javascript">
    var collegeNum = ["土木工程学院",
        "管理工程学院",
        "热能工程学院",
        "市政与环境工程学院",
        "建筑城规学院",
        "艺术学院",
        "机电工程学院",
        "信息与电气工程学院",
        "商学院",
        "材料科学与工程学院",
        "计算机科学与技术学院",
        "理学院",
        "法政学院",
        "外国语学院",
        "交通工程学院",
        "测绘地理信息学院",
        "马克思主义学院"
    ]
    var collect = document.getElementById("college")
    var old = collect.innerHTML

    function load() {
        var lineNu = "";
        for (var j = 0; j < collegeNum.length; j++) {
            lineNu += '<option>' + collegeNum[j] + '</option>';
        }
        collect.innerHTML = old + lineNu;
    } //网页加载时执行此函数，为线路选择框动态添加选项
    load();
    var professionArr = [
        ["土木工程", "城市地下空间工程"],
        ["工程管理", "工程造价", "房地产开发与管理", "信息管理与信息系统", "土地资源管理", "工业工程"],
        ["建筑环境与能源应用工程", "能源与动力工程", "新能源科学与工程"],
        ["给排水科学与工程", "环境工程", "环境科学", "生物工程"],
        ["建筑学", "城乡规划", "风景园林（景观规划设计方向）"],
        ["环境设计（环境艺术设计方向）", "环境设计（景观艺术设计方向）", "工业设计", "视觉传达设计",
            "美术学（油画方向）", "广告学", "风景园林（园林规划设计方向）"],
        ["机械工程", "车辆工程", "机械电子工程"],
        ["电气工程及其自动化", "建筑电气与智能化", "电子信息工程", "通信工程", "物联网工程"],
        ["工商管理", "市场营销", "会计学", "财务管理", "电子商务"],
        ["材料科学与工程", "材料成型及控制工程", "焊接技术与工程", "无机非金属材料工程（建筑材料方向）"],
        ["计算机科学与技术", "网络工程", "软件工程（软件开发方向）", "软件工程（软件测试方向）"],
        ["光电信息科学与工程", "信息与计算科学", "应用统计学", "应用物理学"],
        ["法学", "社会工作"],
        ["英语", "德语"],
        ["交通工程", "道路桥梁与渡河工程（轨道交通方向）", "道路桥梁与渡河工程（道路桥梁方向）"],
        ["测绘工程", "地理信息科学"],
        ["——"]
    ]

    function getprofession() {
        var line_num = document.user_form.college;
        var station_name = document.user_form.profession;
        var lineStation = professionArr[line_num.selectedIndex - 1];
        station_name.length = 1;
        for (var i = 0; i < lineStation.length; i++) {
            station_name[i + 1] = new Option(lineStation[i], lineStation[i]);
        }
    } //为站点选择框根据线路选择框的值动态添加选项
</script>

<!-- 手机验证码 -->
<script type="text/javascript">
    // 倒计时60s
    let countdown = 60;

    function settime() {
        if (countdown == 0) {
            $('#yzm').attr('onclick', 'sendCode');
            $('#yzm').text('发送验证码');
            countdown = 60;
        } else {
            $('#yzm').removeAttr('onclick', 'sendCode');
            $('#yzm').text('重新发送（' + countdown + 's)');
            countdown--;
            setTimeout(function () {
                settime();
            }, 1000);
        }
    }

    function sendCode() {
        // 1. 获取手机号
        var phone = $("input[name='phone_num']").val();
        // alert(phone);
        console.log(phone);
        // 2. 判断手机号是否为空
        if (!phone) {
            $("#layer").html("手机号不能为空");
            return;
        }

        settime();

        // 3. 触发ajax，请求验证码,根据是否成功，给提示信息
        $.get('sendcode', {'phone': phone, 'type': 'register'}, function (data) {
            if (data.status === 0) {
                $("#layer").html("发送成功");
            } else {
                $("#layer").html("发送失败");
            }
        });


    }
</script>
@if (count($errors) > 0)
    <?php
    $str_error = '';
    foreach ($errors->all() as $error) {
        $str_error = $str_error . $error . '\n';
    }
    $errors = null;
    echo "<script>alert('$str_error');</script>";
    ?>
@endif
</body>


<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
</html>
