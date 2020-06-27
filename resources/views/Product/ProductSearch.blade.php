@extends('Product.base')
@section('head')
    <link href="/css/pagination.css" rel="stylesheet" type="text/css"/>
@endsection
@section('main')
    <div class="i_bg">
        <div class="postion">
        <span class="fl">全部
{{--            @if(count($products) > 0)--}}
{{--                > {{ $products[0]['label'][0] }}--}}
{{--            @endif--}}
            > </span>
            <span class="n_ch">
            <span class="fl"><font>{{ Request::get('search') }}</font></span>
        </span>
        </div>
        <!--Begin 筛选条件 Begin-->
        <div class="content mar_10">
            {{--        <table border="0" class="choice" style="width:100%; font-family:'宋体'; margin:0 auto;" cellspacing="0"--}}
            {{--               cellpadding="0">--}}
            {{--            <tr valign="top">--}}
            {{--                <td width="70">&nbsp; 品牌：</td>--}}
            {{--                <td class="td_a"><a href="#" class="now">香奈儿（Chanel）</a><a href="#">迪奥（Dior）</a><a--}}
            {{--                        href="#">范思哲（VERSACE）</a><a href="#">菲拉格慕（Ferragamo）</a><a href="#">兰蔻（LANCOME）</a><a href="#">爱马仕（HERMES）</a><a--}}
            {{--                        href="#">卡文克莱（Calvin Klein）</a><a href="#">古驰（GUCCI）</a><a href="#">宝格丽（BVLGARI）</a><a href="#">阿迪达斯（Adidas）</a><a--}}
            {{--                        href="#">卡尔文·克莱恩（CK）</a><a href="#">凌仕（LYNX）</a><a href="#">大卫杜夫（Davidoff）</a><a href="#">安娜苏（Anna--}}
            {{--                        sui）</a><a href="#">阿玛尼（ARMANI）</a><a href="#">娇兰（Guerlain）</a></td>--}}
            {{--            </tr>--}}
            {{--            <tr valign="top">--}}
            {{--                <td>&nbsp; 价格：</td>--}}
            {{--                <td class="td_a"><a href="#">0-199</a><a href="#" class="now">200-399</a><a href="#">400-599</a><a--}}
            {{--                        href="#">600-899</a><a href="#">900-1299</a><a href="#">1300-1399</a><a href="#">1400以上</a></td>--}}
            {{--            </tr>--}}
            {{--            <tr>--}}
            {{--                <td>&nbsp; 类型：</td>--}}
            {{--                <td class="td_a"><a href="#">女士香水</a><a href="#">男士香水</a><a href="#">Q版香水</a><a href="#">组合套装</a><a--}}
            {{--                        href="#">香体走珠</a><a href="#">其它</a></td>--}}
            {{--            </tr>--}}
            {{--            <tr>--}}
            {{--                <td>&nbsp; 香型：</td>--}}
            {{--                <td class="td_a"><a href="#">浓香水</a><a href="#">香精Parfum香水</a><a href="#">淡香精EDP淡香水</a><a--}}
            {{--                        href="#">香露EDT</a><a href="#">古龙水</a><a href="#">其它</a></td>--}}
            {{--            </tr>--}}
            {{--        </table>--}}
        </div>
        <!--End 筛选条件 End-->

        <div class="content mar_20">
            <div class="l_list">
                <div class="list_t">
                    {{--            	<span class="fl list_or">--}}
                    {{--                	<a href="#" class="now">默认</a>--}}
                    {{--                    <a href="#">--}}
                    {{--                    	<span class="fl">价格</span>--}}
                    {{--                        <span class="i_up">价格从低到高显示</span>--}}
                    {{--                        <span class="i_down">价格从高到低显示</span>--}}
                    {{--                    </a>--}}
                    {{--                    <a href="#">新品</a>--}}
                    {{--                </span>--}}
                    <span class="fr">共发现 <font color="#a52a2a">{{ count($products) }}</font> 件</span>
                </div>
                <div class="list_c">
                    <ul class="cate_list">
                        @if(count($products)==0)
                            <?php echo "没有您想要的商品" ?>
                        @else
                            @foreach($products as $product)
                                <li>
                                    <div class="img"><a href="/product/detail/{{ $product['id'] }}"><img
                                                src="/storage/{{ $product['image'][0] }}" width="210"
                                                height="185"/></a></div>
                                    <div class="price">
                                        <font>￥<span>{{ $product['price'] }}</span></font>
                                    </div>
                                    <div class="name"><a
                                            href="/product/detail/{{ $product['id'] }}">{{ $product['title'] }}</a>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
@endsection
