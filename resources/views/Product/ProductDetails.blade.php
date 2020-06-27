@extends('Product.base')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('main')
    <!--with的参数1是一个session变量名，参数2为该session变量值，在视图直接这样获取-->
    {{--    @if(isset($success))--}}
    {{--        <script>alert('已添加至“我的收藏”列表');</script>--}}
    {{--    @endif--}}
    <div class="i_bg">
        <div class="postion">
            <span class="fl">全部
                @if($product['label']!=null)
                    @foreach($product['label'] as $la)
                        > {{ $la }}
                    @endforeach>
                @endif
            </span>
        </div>
        <div class="content mar_10">
            <!--Begin 特卖 Begin-->
            <div class="s_left">
                <div class="lim_time">
                    <table border="0" style="width:100%; margin-bottom:50px;" cellspacing="0" cellpadding="0">
                        <tr valign="top">
                            <td width="315">
                                <div class="lim_name">{{ $product['title'] }}</div>
                                <div class="lim_price">
                                    <span class="ch_txt">￥{{ $product['price'] }}</span>
                                    {{--                                    <a href="{{ route('Iwant',array('student_id'=>'201611101056','product_id'=>$product_id)) }}"--}}
                                    <a href="javascript:;" onclick="shoucang()" class="ch_a" id="soucang">收藏</a>
                                </div>
                                <br/> <br/>
                                <div class="lim_c">
                                    <span>发布时间 ：{{ date('Y-m-d') }}</span>
                                </div>
                                <div class="lim_c">
                            <span>联系方式
{{--                                <p>&nbsp;QQ：<a--}}
                                {{--                                        href="tencent://AddContact/?fromId=45&fromSubId=1&subcmd=all&uin=1192369119&website=www.oicqzone.com">添加好友</a>--}}
                                {{--                                </p><p>&nbsp; <font style="color:#ff3200">*</font>出于安全考虑，暂不支持直接获取对方手机号</p></span>--}}
                                <p>Tel:     &nbsp;&nbsp;&nbsp; {{ $phone_num }}</p>
                                </span>
                                </div>
                            </td>
                            <td width="525" align="center" style="border-left:1px solid #eaeaea;"><img
                                    src="/storage/{{ $product['image'][0] }}" width="460" height="460"/></td>
                        </tr>
                    </table>
                </div>
                <div class="des_border">
                    <div class="des_tit">
                        <ul>
                            <li class="current"><a href="#p_details">商品详情</a></li>
                            <li><a href="#p_comment">商品评论</a></li>
                        </ul>
                    </div>
                    <div class="des_con" id="p_attribute">

                        <table border="0" align="center" style="width:100%; font-family:'宋体'; margin:10px auto;"
                               cellspacing="0" cellpadding="0">
                            <tr>
                                <td>商品名称：{{ $product['title'] }}</td>
                                <td></td>
                                <td></td>
                                <td>上架时间：{{ date('Y-m-d') }} </td>
                            </tr>
                            <tr>
                                <td><br/></td>
                            </tr>
                            <tr>
                                <td colspan="4">&nbsp; &nbsp; {{ $product['description'] }} </td>

                            </tr>
                        </table>

                    </div>
                </div>

                <div class="des_border" id="p_details">
                    <div class="des_t">商品详情</div>
                    <div class="des_con">
                        <p align="center">
                            @foreach($product['image'] as $image)
                                <img src="/storage/{{ $image }}" width="746"/><br/><br/>
                            @endforeach
                        </p>

                    </div>
                </div>

                <div class="des_border" id="p_comment">
                    <div class="des_t">商品评论</div>
                    <div><input type="text" placeholder="快来说点什么吧。。。" name="liuyan" id="liuyan"
                                style="width: 700px;background-color: lavender;height: 30px;">
                        <button style="height: 30px; " onclick="addMes()">发表</button>
                        <div class="btn_2" id="btn_2" style="float: right;margin-right: 10px;"></div>
                    </div>
                    <table border="0" class="jud_list" style="width:100%; margin-top:30px;" cellspacing="0"
                           cellpadding="0">
                        <?php
                        foreach ($mess as $mes) {
                            //echo "123";
//                            dd($mes);
                            echo '<tr valign="top">';
                            echo '<td width="160">' . $mes["leave"]["senderName"] . '  :  ' . $mes["leave"]["content"] . '  <font color="#999aaa" size="2"> ' . $mes["leave"]["time"]->format("m-d H:i") . '</font> <a href="javascript:;" onclick="replayBtn(\'' . $mes["leave"]["senderName"] . '\' ,' . $mes["leave"]["id"] . ',' . $mes["leave"]["senderid"] . ');">回复</a>';
                            if (count($mes['replay']) > 0) {
                                echo '<ul>';
                                foreach ($mes['replay'] as $re_mes) {
                                    echo '<li>&nbsp;' . $re_mes["senderName"] . ' 回复 ' . $re_mes["receiverName"] . ' ：' . $re_mes["content"] . ' <font color="#999aaa" size="2"> ' . $re_mes["time"]->format("m-d H:i:s") . ' </font> <a href="javascript:;" onclick="replayBtn(\'' . $re_mes["senderName"] . '\' ,' . $re_mes["id"] . ',' . $re_mes["senderid"] . ');">回复</a></li>';
                                }
                                echo '</ul>';
                            }
                            echo "</td></tr>";
                        }
                        ?>
                    </table>


                    {{--                                        <div class="pages">
                                                                <div id="pull_right">
                                                                    <div class="pull-right">
                                                                        {!! $mess->render() !!}
                                                                    </div>
                                                                </div>
                                                            </div>--}}

                </div>

            </div>
            <!--End 特卖 End-->

            <div class="s_right">
                <div class="r_history">
                    <div class="r_his_t">该卖家还发布了</div>
                    <ul>
                        <?php
                        $dnsms = array_slice($userProducts, 0, 3);
                        ?>
                        @foreach($dnsms as $dnsm)
                            <li>
                                <div class="img"><a href="/product/detail/{{ $dnsm['id'] }}"><img
                                            src="/storage/{{$dnsm['image'][0]}}" width="185" height="162"/></a>
                                </div>
                                <div class="name"><a href="/product/detail/{{ $dnsm['id'] }}">{{ $dnsm['title'] }}</a>
                                </div>
                                <div class="price">
                                    <font>￥<span>{{ $dnsm['price'] }}</span></font>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{--                                <div class="sell_hot">
                                                    <div class="s_hot_t">
                                                        <span class="fl">热销品牌</span>
                                                        <span class="h_more fr"><a href="#">更多</a></span>
                                                    </div>
                                                    <ul>
                                                        <li><a href="#"><img src="/images/hb_1.jpg" width="160" height="59"/></a></li>
                                                        <li><a href="#"><img src="/images/hb_2.jpg" width="160" height="59"/></a></li>
                                                        <li><a href="#"><img src="/images/hb_3.jpg" width="160" height="59"/></a></li>
                                                        <li><a href="#"><img src="/images/hb_4.jpg" width="160" height="59"/></a></li>
                                                        <li><a href="#"><img src="/images/hb_5.jpg" width="160" height="59"/></a></li>
                                                        <li><a href="#"><img src="/images/hb_6.jpg" width="160" height="59"/></a></li>
                                                        <li><a href="#"><img src="/images/hb_7.jpg" width="160" height="59"/></a></li>
                                                        <li><a href="#"><img src="/images/hb_8.jpg" width="160" height="59"/></a></li>
                                                        <li><a href="#"><img src="/images/hb_9.jpg" width="160" height="59"/></a></li>
                                                        <li><a href="#"><img src="/images/hb_10.jpg" width="160" height="59"/></a></li>
                                                        <li><a href="#"><img src="/images/hb_11.jpg" width="160" height="59"/></a></li>
                                                        <li><a href="#"><img src="/images/hb_12.jpg" width="160" height="59"/></a></li>
                                                    </ul>
                                                </div>--}}
            </div>
        </div>
        <script>
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

            function shoucang() {
                $.get('/user/Iwant/{{ $product["id"] }}', function (response) {
                    // handle your response here
                    if (response == 1) {
                        alert('已添加至“我的收藏”列表');
                        document.getElementById('soucang').innerHTML = "已收藏";
                    }
                    console.log(1);
                    console.log(response);
                })
            }

            console.log('id:' +{{ $product["id"] }});

            let mes_id = -1;
            let receiver_id = -1;

            function replayBtn(name, mesId, receiverid) {
                console.log(name, mesId, receiverid);
                document.getElementById("liuyan").placeholder = "回复: " + name;
                document.getElementById("btn_2").innerHTML = "<button style=\"height: 30px; \" onclick='cancel()'>取消回复</button>";
                mes_id = mesId;
                receiver_id = receiverid;
            }

            function cancel() {
                document.getElementById("liuyan").placeholder = "快来说点什么吧。。。 ";
                document.getElementById("liuyan").value = "";
                document.getElementById("btn_2").innerHTML = "";
            }

            function replayMes() {

            }

            function addMes() {
                // var ly = $("#liuyan").val();
                var ly = document.getElementById("liuyan").value;
                console.log("123" + ly);
                if (ly.match(/^[ ]+$/) || ly === '') {
                    alert("留言内容不能为空！");
                } else {
                    $.post('/user/sendMessage', {
                            productid:{{ $product["id"] }},
                            mes: $("#liuyan").val(),
                            mes_id: mes_id,
                            receiver_id: receiver_id
                        }, function (response) {
                            console.log(response);
                            if (response == 1) {
                                alert('发表成功');
                                window.location.reload();
                            } else {
                                alert('操作失败，请稍后再试');
                            }
                        }
                    )
                }
            }
        </script>
@endsection
