<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>注册-跳蚤市场</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="" rel="stylesheet">
    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
</head>
<body>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<label id="layer" name="layer"></label>
<form method='get' action=" " id="user_form" name="user_form">
    <p> 学号：<input type="text" name="student_id" value=""></p>
    <p> 姓名：<input type="text" name="name" value=""></p>
    <p> 昵称：<input type="text" name="nickname" value=""></p>
    <p> 密码：<input type="password" name="psd" value=""></p>
    <p> 确认密码：<input type="password" name="psd_confirm" value=""></p>
    <p> 学院：
        <select name="college" id="college" onchange="getprofession()">
            <option value="0">请选择学院</option>
        </select>
    </p>
    <p> 专业：
        <select name="profession">
            <option value="0">请选择专业</option>
        </select>
    </p>
    <p> 入学年份：<input type="date" name="start_year" value={{date(now())}}></p>
    <p> 手机号：<input type="text" name="phone_num" value=""></p>
    <p> 手机验证码：<input type="text" name="captcha" value="">
        <a id="yzm" href="javascript:;" onclick="sendCode();" >发送验证码</a>
    </p>
    <p><input type="submit" name="注册" ></p>
</form>
<a href="login">已有帐号，登录</a>

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
    function settime(){
        if(countdown == 0){
            $('#yzm').attr('onclick','sendCode');
            $('#yzm').text('发送验证码');
            countdown = 60;
        }else{
            $('#yzm').removeAttr('onclick','sendCode');
            $('#yzm').text('重新发送（'+countdown+'s)');
            countdown--;
            setTimeout(function () {
                settime();
            },1000);
        }
    }

    function sendCode(){
        // 1. 获取手机号
        var phone = $("input[name='phone_num']").val();
        // alert(phone);
        console.log(phone);
        // 2. 判断手机号是否为空
        if(!phone){
            $("#layer").html("手机号不能为空");
            return ;
        }

        settime();

        // 3. 触发ajax，请求验证码,根据是否成功，给提示信息
        $.get('sendcode',{'phone':phone,'type':'register'},function(data){
            if(data.status === 0){
                $("#layer").html("发送成功");
            }else{
                $("#layer").html("发送失败");
            }
        });


    }
</script>

</body>
</html>
