<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>注册-跳蚤市场</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="" rel="stylesheet">
</head>
<body>
<label id="layer"></label>
<form id="forget_form" action="">
    <p>学号：<input name="student_id" type="text" value=""></p>
    <p>手机号：<input name="phone_num" type="text" value=""></p>
    <p>验证码：<input name="" type="text" value="">
        <a id="yzm" href="javascript:;" onclick="sendCode();" >发送验证码</a>
    </p>
    <p>新密码：<input name="" type="text" value=""></p>
    <p>确认密码:<input name="" type="text" value=""></p>
    <p><input type="submit" name="确认修改"></p>
</form>
</body>
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

        // 2. 判断手机号是否为空
        if(!phone){
            $("#layer").html("手机号不能为空");
            return ;
        }

        settime();

        // 3. 触发ajax，请求验证码,根据是否成功，给提示信息
        $.get('sendcode',{'type':'change','phone':phone},function(data){
            if(data.status === 0){
                $("#layer").html("发送成功");
            }else{
                $("#layer").html("发送失败");
            }
        });


    }
</script>
</html>

