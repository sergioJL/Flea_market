@extends('User.base2')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="/css/common_a.css" rel="stylesheet" tyle="text/css"/>
<link href="/css/style_a.css" rel="stylesheet" type="text/css"/>
<link href="/css/fonts/iconfont.css" rel="stylesheet" type="text/css"/>
<script src="/js/admin/jquery.min.1.8.2.js" type="text/javascript"></script>
<script src="/js/admin/payfor.js" type="text/javascript"></script>
<script src="/js/admin/lrtk.js" type="text/javascript"></script>
<script src="/js/admin/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/js/admin/common_js.js" type="text/javascript"></script>
<script src="/js/admin/footer.js" type="text/javascript"></script>
<script src="/js/admin/jquery.jumpto.js" type="text/javascript"></script>
@section('main')
    <!--帮助中心-->
    <div class="rcont">
        <div class="shopProcess">
            <div class="h_qus_box">
                <br/>
                <h2 class="hp_tle" style="padding-left: 25px;">帮助中心</h2>
                <br/>
                <ul class="qus_list">
                    <li>
                        <h5 class="qus_title"><span class="right">&nbsp;</span>1. 忘记登录密码了怎么办？</h5>
                        <div class="answer_wrap">
                            <p>第一步：通过登录界面点击“忘记密码”，然后按页面提示操作即可。</p>
                            <p>第二步：进入安全中心，输入账户名和验证码，再点击“下一步”。</p>
                            <p>
                                第三步：验证身份，选择验证方式（验证方式根据登录环境而定，分为身验证密保找回，获取验证码，点击“确定”；和短信找回，发送短信，点击“我已发送”）（如果绑定的手机已停用，请点击蓝色字体“人工申诉”查看）</p>
                            <p>第四步：重置密码，输入您的新密码，点击“确定”。</p>
                            <p>第五步：密码重置成功，重新登录即可。</p>
                        </div>
                    </li>

                    <li>
                        <h5 class="qus_title"><span class="right">&nbsp;</span>2.修改密码在哪里</h5>
                        <div class="answer_wrap">
                            <p>依次点击 个人中心 - 账户安全 - 修改密码</p>
                        </div>
                    </li>
                </ul>
                <script type="text/javascript">
                    $(function () {
                        $(".h_qus_box ul li").click(function () {
                            $(this).find('.answer_wrap').toggle();
                            $(this).toggleClass('current_show');
                        }, function () {
                            $(this).find('.answer_wrap').toggle();
                        }).hover(function () {
                            $(this).find('.qus_title').addClass("cur_hover");
                        }, function () {
                            $(this).find('.qus_title').removeClass("cur_hover");
                        })
                    })
                </script>
            </div>
        </div>
    </div>
@endsection
