@extends('Product.base')
@section('main')
    <div class="i_ban_bg">
        <!--Begin Banner Begin-->
        <div class="banner">
            <div class="top_slide_wrap">
                <ul class="slide_box bxslider">
                    <li><img src="/images/ban1.jpg" width="950" height="401"/></li>
                    <li><img src="/images/ban2.jpg" width="950" height="401"/></li>
                    <li><img src="/images/iStock.png" width="950" height="401"/></li>
                </ul>
                <div class="op_btns clearfix">
                    <a href="#" class="op_btn op_prev"><span></span></a>
                    <a href="#" class="op_btn op_next"><span></span></a>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            //var jq = jQuery.noConflict();
            (function () {
                $(".bxslider").bxSlider({
                    auto: true,
                    prevSelector: jq(".top_slide_wrap .op_prev")[0], nextSelector: jq(".top_slide_wrap .op_next")[0]
                });
            })();
        </script>
        <!--End Banner End-->
        <div class="inews">
            <div class="news_t">
                <span class="fr"><a href="/user/notice">更多 ></a></span>本站资讯
            </div>
            <ul>
                @foreach($anno as $a)
                    <li><span>[ 公告 ]</span><a href="#">{{ $a['title'] }}</a></li>
                @endforeach
{{--                <li><span>[ 公告 ]</span><a href="#">网站更新公告</a></li>--}}
{{--                <li><span>[ 公告 ]</span><a href="#">网站操作指南</a></li>--}}
{{--                <li><span>[ 公告 ]</span><a href="#">致广大用户的一封信</a></li>--}}
{{--                <li><span>[ 公告 ]</span><a href="#">又是一年毕业季，快来淘点好货</a></li>--}}
            </ul>
        </div>
    </div>

    <!--Begin 限时特卖 Begin-->
    <div class="i_t mar_10">
        <span class="fl">最新发布</span>
        <span class="i_mores fr"><a href="/product/search?search=all">更多</a></span>
    </div>
    <div class="content">
        <div class="i_sell">
            <div id="imgPlay">
                <ul class="imgs" id="actor">
                    <li><a href="#"><img src="/images/tm_r.jpg" width="211" height="357"/></a></li>
                    <li><a href="#"><img src="/images/tm_r.jpg" width="211" height="357"/></a></li>
                    <li><a href="#"><img src="/images/tm_r.jpg" width="211" height="357"/></a></li>
                </ul>
                <div class="previ">上一张</div>
                <div class="nexti">下一张</div>
            </div>
        </div>
        <div class="sell_right">
            <?php $products = array_slice($all, 0, 4) ?>
            @foreach ($products as $product)
                <div class="prod" onclick="location.href='/product/detail/{{ $product['id'] }}'">
                    {{--    <form method="get" style="width: 200px;height: 330px; float: left;text-align: center;">--}}
                    <p><img src="/storage/{{$product['image'][0]}}" width="200px" height="300px"
                            alt="" onerror="this.src='/storage/99920a787050a10e9db6e5fe9d8bba49.jpg'"></p>
                    <p><input type="text" value="{{$product['title']}}" size="{{ strlen($product['title'])/2}}"
                              style="float:left;max-width: 130px;" readonly="readonly">
                        <input type="text" value="￥{{number_format($product['price'],2)}}"
                               size="{{ strlen($product['price'])+2 }}" style="float: right;" readonly="readonly">
                    </p>
                    {{--    </form>--}}
                </div>
            @endforeach
        </div>
    </div>
    <!--End 限时特卖 End-->
    <div class="content mar_20">
        <img src="/images/mban_1.png" width="1200" height="110"/>
    </div>
    <!--Begin 进口 生鲜 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">1F</span>
        <span class="fl">电脑 <b>·</b> 数码</span>
    </div>
    <div class="content">
        <div class="fresh_left">
            <div class="fre_ban">
                <div id="imgPlay1">
                    <ul class="imgs" id="actor1">
                        <li><a href="#"><img src="/images/homepage/1F_1.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/1F_2.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/1F_3.jpg" width="211" height="286"/></a></li>
                    </ul>
                    <div class="prevf">上一张</div>
                    <div class="nextf">下一张</div>
                </div>
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="/product/search?search=手机">手机</a><a href="/product/search?search=电脑">电脑</a>
                    <a href="/product/search?search=智能手表">智能手表</a><a href="/product/search?search=相机">相机</a>
                    <a href="/product/search?search=键鼠">键鼠</a><a href="/product/search?search=配件">配件</a>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($F[0] as $dnsm)
                    <li>
                        <div class="name"><a href="/product/detail/{{ $dnsm['id'] }}">{{ $dnsm['title'] }}</a></div>
                        <div class="price">
                            <font>￥<span>{{ $dnsm['price'] }}</span></font> &nbsp
                        </div>
                        <div class="img"><a href="/product/detail/{{ $dnsm['id'] }}"><img
                                    src="/storage/{{$dnsm['image'][0]}}" width="185" height="155"/></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="/images/homepage/1F_2.jpg" width="260" height="220"/></a></li>
                <li><a href="#"><img src="/images/homepage/1F_3.jpg" width="260" height="220"/></a></li>
            </ul>
        </div>
    </div>
    <!--End 进口 生鲜 End-->
    <!--Begin 食品饮料 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">2F</span>
        <span class="fl">运动户外</span>
    </div>
    <div class="content">
        <div class="food_left">
            <div class="food_ban">
                <div id="imgPlay2">
                    <ul class="imgs" id="actor2">
                        <li><a href="#"><img src="/images/homepage/2F_a1.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/2F_a2.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/2F_a3.jpg" width="211" height="286"/></a></li>
                    </ul>
                    <div class="prev_f">上一张</div>
                    <div class="next_f">下一张</div>
                </div>
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="/product/search?search=运动服饰">运动服饰</a><a href="/product/search?search=户外装备">户外装备</a><a href="/product/search?search=运动器材">运动器材</a>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($F[1] as $dnsm)
                    <li>
                        <div class="name"><a href="/product/detail/{{ $dnsm['id'] }}">{{ $dnsm['title'] }}</a></div>
                        <div class="price">
                            <font>￥<span>{{ $dnsm['price'] }}</span></font>
                        </div>
                        <div class="img"><a href="/product/detail/{{ $dnsm['id'] }}"><img
                                    src="/storage/{{$dnsm['image'][0]}}" width="185" height="155"/></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="/images/homepage/2F_b1.jpg" width="260" height="220"/></a></li>
                <li><a href="#"><img src="/images/homepage/2F_b2.jpg" width="260" height="220"/></a></li>
            </ul>
        </div>
    </div>
    <!--End 食品饮料 End-->
    <!--Begin 个人美妆 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">3F</span>
        <span class="fl">服饰鞋包</span>
    </div>
    <div class="content">
        <div class="make_left">
            <div class="make_ban">
                <div id="imgPlay3">
                    <ul class="imgs" id="actor3">
                        <li><a href="#"><img src="/images/homepage/3F_a1.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/3F_a2.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/3F_a3.jpg" width="211" height="286"/></a></li>
                    </ul>
                    <div class="prev_m">上一张</div>
                    <div class="next_m">下一张</div>
                </div>
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="/product/search?search=男装">男装</a><a href="/product/search?search=女装">女装</a>
                    <a href="/product/search?search=男鞋">男鞋</a><a href="/product/search?search=女鞋">女鞋</a>
                    <a href="/product/search?search=男包">男包</a><a href="/product/search?search=女包">女包</a>
                    <a href="/product/search?search=箱包">箱包</a>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($F[2] as $dnsm)
                    <li>
                        <div class="name"><a href="/product/detail/{{ $dnsm['id'] }}">{{ $dnsm['title'] }}</a></div>
                        <div class="price">
                            <font>￥<span>{{ $dnsm['price'] }}</span></font> &nbsp;
                        </div>
                        <div class="img"><a href="/product/detail/{{ $dnsm['id'] }}"><img
                                    src="/storage/{{$dnsm['image'][0]}}" width="185" height="155"/></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="/images/homepage/3F_b1.jpg" width="260" height="220"/></a></li>
                <li><a href="#"><img src="/images/homepage/3F_b2.jpg" width="260" height="220"/></a></li>
            </ul>
        </div>
    </div>
    <!--End 个人美妆 End-->
    <div class="content mar_20">
        <img src="/images/mban_1.png" width="1200" height="110"/>
    </div>
    <!--Begin 母婴玩具 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">4F</span>
        <span class="fl">个护化妆</span>
    </div>
    <div class="content">
        <div class="baby_left">
            <div class="baby_ban">
                <div id="imgPlay4">
                    <ul class="imgs" id="actor4">
                        <li><a href="#"><img src="/images/homepage/4F_a1.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/4F_a2.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/4F_a3.jpg" width="211" height="286"/></a></li>
                    </ul>
                    <div class="prev_b">上一张</div>
                    <div class="next_b">下一张</div>
                </div>
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="/product/search?search=男士">男士</a><a href="/product/search?search=女士">女士</a>
                    <a href="/product/search?search=面部护理">面部护理</a><a href="/product/search?search=身体护肤">身体护肤</a>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($F[3] as $dnsm)
                    <li>
                        <div class="name"><a href="/product/detail/{{ $dnsm['id'] }}">{{ $dnsm['title'] }}</a></div>
                        <div class="price">
                            <font>￥<span>{{ $dnsm['price'] }}</span></font> &nbsp;
                        </div>
                        <div class="img"><a href="/product/detail/{{ $dnsm['id'] }}"><img
                                    src="/storage/{{$dnsm['image'][0]}}" width="185" height="155"/></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="/images/homepage/4F_b1.jpg" width="260" height="220"/></a></li>
                <li><a href="#"><img src="/images/homepage/4F_b2.jpg" width="260" height="220"/></a></li>
            </ul>
        </div>
    </div>
    <!--End 母婴玩具 End-->
    <!--Begin 家居生活 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">5F</span>
        <span class="fl">日用百货</span>
    </div>
    <div class="content">
        <div class="home_left">
            <div class="home_ban">
                <div id="imgPlay5">
                    <ul class="imgs" id="actor5">
                        <li><a href="#"><img src="/images/homepage/5F_a1.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/5F_a2.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/5F_a3.jpg" width="211" height="286"/></a></li>
                    </ul>
                    <div class="prev_h">上一张</div>
                    <div class="next_h">下一张</div>
                </div>
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="#"></a></div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($F[4] as $dnsm)
                    <li>
                        <div class="name"><a href="/product/detail/{{ $dnsm['id'] }}">{{ $dnsm['title'] }}</a></div>
                        <div class="price">
                            <font>￥<span>{{ $dnsm['price'] }}</span></font> &nbsp;
                        </div>
                        <div class="img"><a href="/product/detail/{{ $dnsm['id'] }}"><img
                                    src="/storage/{{$dnsm['image'][0]}}" width="185" height="155"/></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="/images/homepage/5F_b1.jpg" width="260" height="220"/></a></li>
                <li><a href="#"><img src="/images/homepage/5F_b2.jpg" width="260" height="220"/></a></li>
            </ul>
        </div>
    </div>
    <!--End 家居生活 End-->
    <!--Begin 数码家电 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">6F</span>
        <span class="fl">配饰腕表</span>
    </div>
    <div class="content">
        <div class="tel_left">
            <div class="tel_ban">
                <div id="imgPlay6">
                    <ul class="imgs" id="actor6">
                        <li><a href="#"><img src="/images/homepage/6F_a1.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/6F_a2.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/6F_a3.jpg" width="211" height="286"/></a></li>
                    </ul>
                    <div class="prev_t">上一张</div>
                    <div class="next_t">下一张</div>
                </div>
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="/product/search?search=钟表">钟表</a><a href="/product/search?search=珠宝">珠宝</a>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($F[5] as $dnsm)
                    <li>
                        <div class="name"><a href="/product/detail/{{ $dnsm['id'] }}">{{ $dnsm['title'] }}</a></div>
                        <div class="price">
                            <font>￥<span>{{ $dnsm['price'] }}</span></font> &nbsp;
                        </div>
                        <div class="img"><a href="/product/detail/{{ $dnsm['id'] }}"><img
                                    src="/storage/{{$dnsm['image'][0]}}" width="185" height="155"/></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="/images/homepage/6F_b1.jpg" width="260" height="220"/></a></li>
                <li><a href="#"><img src="/images/homepage/6F_b2.jpg" width="260" height="220"/></a></li>
            </ul>
        </div>
    </div>
    <!--End 数码家电 End-->
    <!--Begin 数码家电 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">7F</span>
        <span class="fl">图书影像</span>
    </div>
    <div class="content">
        <div class="book_left">
            <div class="book_ban">
                <div id="imgPlay7">
                    <ul class="imgs" id="actor7">
                        <li><a href="#"><img src="/images/homepage/7F_a1.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/7F_a2.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/7F_a3.jpg" width="211" height="286"/></a></li>
                    </ul>
                    <div class="prev_t">上一张</div>
                    <div class="next_t">下一张</div>
                </div>
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="/product/search?search=电子书刊">电子书刊</a><a href="/product/search?search=音像制品">音像制品</a>
                    <a href="/product/search?search=音乐影视">音乐影视</a><a href="/product/search?search=经济管理">经济管理</a>
                    <a href="/product/search?search=文化艺术">文化艺术</a><a href="/product/search?search=少儿读物">少儿读物</a>
                    <a href="/product/search?search=流行娱乐">流行娱乐</a><a href="/product/search?search=文学诗歌">文学诗歌</a>
                    <a href="/product/search?search=生活教育">生活教育</a><a href="/product/search?search=科学技术">科学技术</a>
                    <a href="/product/search?search=期刊杂志">期刊杂志</a><a href="/product/search?search=工具书漫画">工具书漫画</a>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($F[6] as $dnsm)
                    <li>
                        <div class="name"><a href="/product/detail/{{ $dnsm['id'] }}">{{ $dnsm['title'] }}</a></div>
                        <div class="price">
                            <font>￥<span>{{ $dnsm['price'] }}</span></font> &nbsp;
                        </div>
                        <div class="img"><a href="/product/detail/{{ $dnsm['id'] }}"><img
                                    src="/storage/{{$dnsm['image'][0]}}" width="185" height="155"/></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="/images/homepage/7F_b1.jpg" width="260" height="220"/></a></li>
                <li><a href="#"><img src="/images/homepage/7F_b2.jpg" width="260" height="220"/></a></li>
            </ul>
        </div>
    </div>
    <!--End 数码家电 End-->
    <!--Begin 数码家电 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">8F</span>
        <span class="fl">玩模乐器</span>
    </div>
    <div class="content">
        <div class="mus_left">
            <div class="mus_ban">
                <div id="imgPlay8">
                    <ul class="imgs" id="actor8">
                        <li><a href="#"><img src="/images/homepage/8F_a1.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/8F_a2.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/8F_a3.jpg" width="211" height="286"/></a></li>
                    </ul>
                    <div class="prev_t">上一张</div>
                    <div class="next_t">下一张</div>
                </div>
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="/product/search?search=玩具">玩具</a><a href="/product/search?search=模型">模型</a>
                    <a href="/product/search?search=二次元周边">二次元周边</a><a href="/product/search?search=乐器">乐器</a>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($F[7] as $dnsm)
                    <li>
                        <div class="name"><a href="/product/detail/{{ $dnsm['id'] }}">{{ $dnsm['title'] }}</a></div>
                        <div class="price">
                            <font>￥<span>{{ $dnsm['price'] }}</span></font> &nbsp;
                        </div>
                        <div class="img"><a href="/product/detail/{{ $dnsm['id'] }}"><img
                                    src="/storage/{{$dnsm['image'][0]}}" width="185" height="155"/></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="/images/homepage/8F_b1.jpg" width="260" height="220"/></a></li>
                <li><a href="#"><img src="/images/homepage/8F_b2.jpg" width="260" height="220"/></a></li>
            </ul>
        </div>
    </div>
    <!--End 数码家电 End-->
    <!--Begin 数码家电 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">9F</span>
        <span class="fl">办公设备</span>
    </div>
    <div class="content">
        <div class="work_left">
            <div class="work_ban">
                <div id="imgPlay9">
                    <ul class="imgs" id="actor9">
                        <li><a href="#"><img src="/images/homepage/9F_a1.jpg" width="211" height="286"/></a></li>
                        <li><a href="#"><img src="/images/homepage/9F_a2.jpg" width="211" height="286"/></a></li>
                    </ul>
                    <div class="prev_t">上一张</div>
                    <div class="next_t">下一张</div>
                </div>
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="/product/search?search=办公仪器">办公仪器</a><a href="/product/search?search=文具用品">文具用品</a>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                @foreach($F[8] as $dnsm)
                    <li>
                        <div class="name"><a href="/product/detail/{{ $dnsm['id'] }}">{{ $dnsm['title'] }}</a></div>
                        <div class="price">
                            <font>￥<span>{{ $dnsm['price'] }}</span></font> &nbsp;
                        </div>
                        <div class="img">
                            <a href="/product/detail/{{ $dnsm['id'] }}">
                                <img src="/storage/{{$dnsm['image'][0]}}" width="185" height="155"/></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="/images/homepage/9F_b1.jpg" width="260" height="220"/></a></li>
                <li><a href="#"><img src="/images/homepage/9F_b2.jpg" width="260" height="220"/></a></li>
            </ul>
        </div>
    </div>
    <!--End 数码家电 End-->
@endsection
