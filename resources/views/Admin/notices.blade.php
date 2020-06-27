@extends('Admin.base')
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
@section('left')
    <li><a href="/admin/tobeprocess" class="on"><em></em><span>站内公告</span></a></li>
    <li><a href="/admin/userlist"><em></em><span>用户信息</span></a></li>
    <li><a href="/admin/productlist/sell"><em></em><span>商品信息</span></a></li>
    <li><a href="/admin/Messagelist"><em></em><span>留言信息</span></a></li>
@endsection
<style>
    .form_gonggao{
        padding: 50px 15px 15px 15px;
        text-align: center;
    }
    .form-title{
        width: 928px;
        font-size: 20px;
    }
    .form-submit{
        width:318px; height:42px; line-height:42px\9; overflow:hidden; background:url(../images/btn_log.gif) repeat-x center top; color:#FFF; font-size:16px; font-family:"Microsoft YaHei"; text-align:center; padding:0; border:0; cursor:pointer; -webkit-border-radius:2px; -moz-border-radius:2px; border-radius:2px;

    }
</style>

@section('right')
<!--帮助中心-->
<div class="rcont" style="height: 800px;">
    <div class="shopProcess">
        <div class="h_qus_box">
            <br/>
            <h2 class="hp_tle" style="padding-left: 25px;">站内公告</h2>
            <a style="float: right;font-size: 20px;margin-top: -25px;margin-right: 50px" href="/admin/gonggao">添 加</a>
            <br/>
            <ul class="qus_list">
                @foreach($notices as $notice)
                    <li>
                        <h5 class="qus_title"><span class="right">&nbsp;</span>{{ $notice['title'] }} <spanc style="width: 200px;float: right;">{{ $notice['time'] }}</spanc></h5>
                        <div class="answer_wrap">
                            <?php echo $notice['content'] ?>
                        </div>
                    </li>
                @endforeach
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
