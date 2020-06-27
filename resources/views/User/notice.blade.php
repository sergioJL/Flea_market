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
                <h2 class="hp_tle" style="padding-left: 25px;">站内公告</h2>
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
