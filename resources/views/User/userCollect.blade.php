@extends('User.base2')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/pagination.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/js/jquery-1.11.1.min_044d0927.js"></script>
    <style>
        .black_overlay{
            display: none;
            position: absolute;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;
            background-color: black;
            z-index:1001;
            -moz-opacity: 0.8;
            opacity:.80;
            filter: alpha(opacity=88);
        }
        .white_content {
            display: none;
            position: absolute;
            top: 30%;
            left: 60%;
            width: 250px;
            /*height: 50px;*/
            padding: 50px 5px 5px 30px;
            border: 2px solid #69e147;
            border-radius: 5px;
            background-color: white;
            z-index:1002;
            overflow: auto;
        }
    </style>
@endsection

@section('main')
    <p></p>
    <div class="mem_tit">
        <span class="fr" style="font-size:12px; color:#55555; font-family:'宋体'; margin-top:5px;">共发现{{ $num }}件</span>我发布的
    </div>
    <table border="0" class="order_tab" style="width:930px;" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" width="420">商品名称</td>
            <td align="center" width="200">价格</td>
            <td align="center" width="250">操作</td>
        </tr>
        @foreach($products as $product)
            <tr>
                <td style="font-family:'宋体';">
                    <div class="sm_img"><img src="/storage/{{$product['image'][0]}}"
                                             onerror="this.src='/storage/99920a787050a10e9db6e5fe9d8bba49.jpg'"
                                             width="48" height="48" alt=""/></div>
                    {{ $product['title'] }}
                </td>
                <td align="center">￥{{ $product['price'] }}  &nbsp;&nbsp;&nbsp; <a href="javascript:openDialog({{ $product['id'] }});">修改</a> </td>
                <td align="center">
                    <a href="/product/detail/{{ $product['id'] }}">详情</a>&nbsp; &nbsp; &nbsp; &nbsp;
                    <a href="/product/delete/{{ $product['id'] }}">删除</a></td>
            </tr>
        @endforeach
    </table>
    <div id="pagination">
        <div id="pull_right">
            <div class="pull-right">
                {!! $products->render() !!}
            </div>
        </div>
    </div>

    <div id="light" class="white_content">
            <input type="text" name="new_price" id="new_price" value="" size="3" oninput="value=value.replace(/[^\d]/g,'')" style="font-size: 25px;">
            <input type="submit" value="确认" onclick="change_price()" style="font-size: 25px;">
            <input type="submit" value="X" onclick="closeDialog()" style="font-size: 25px;">
        <!--    <a href = "javascript:void(0)" onclick = "closeDialog()">点这里关闭本窗口</a>-->
    </div>
    <div id="fade" class="black_overlay"></div>
    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        // $(function(){
        // })
        let product_id = -1;
        function openDialog(id){
            product_id = id;
            console.log(product_id);
            document.getElementById('light').style.display='block';
            document.getElementById('fade').style.display='block'
        }
        function closeDialog(){
            document.getElementById('light').style.display='none';
            document.getElementById('fade').style.display='none'
        }

        function te01() {
            alert("ok");
        }

        function change_price() {
            // var ly = $("#new_price").val();
            var ly = document.getElementById("new_price").value;
            console.log(ly);
            if (ly.match(/^[ ]+$/) || ly === '') {
                alert("内容不能为空！");
            } else {
                $.post('/product/change/price', {
                        id:product_id,
                        price:ly
                    }, function (response) {
                        console.log(response);
                        if (response == 1) {
                            alert('修改成功');
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
