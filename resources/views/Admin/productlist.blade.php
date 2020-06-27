@extends('Admin.base')
@section('head')
    <link href="/css/pagination.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        .des{
            width: 250px;
            /*border:2px solid black;*/
            overflow:hidden;
            text-overflow: ellipsis;
            /*-webkit-text-overflow:ellipsis;*/
            white-space: nowrap;
        }
    </style>
@endsection
@section('left')
    <li><a href="/admin/tobeprocess"><em></em><span>站内公告</span></a></li>
    <li><a href="/admin/userlist"><em></em><span>用户信息</span></a></li>
    <li><a href="/admin/productlist/sell" class="on"><em></em><span>商品信息</span></a></li>
    <li><a href="/admin/Messagelist"><em></em><span>留言信息</span></a></li>
@endsection


@section('right')
    <div style="height:800px;text-align: center; ">
        <div style="width: 100%; top: 50px; font-size: 19px; top: 5px;">
            @if($type=='sell')
                <div style="float:left; width:50%;height: 40px; border:1px solid #eaeaea;background-color: #bf5329"><a
                        href="/admin/productlist/sell">用 户 出 售</a></div>
                <div style="float:right; width:49.5%;height:40px; border:1px solid #eaeaea; "><a
                        href="/admin/productlist/find">用 户 寻 求</a></div>
            @else
                <div style="float:left; width:50%;height: 40px; border:1px solid #eaeaea;"><a
                        href="/admin/productlist/sell">用 户 出 售</a></div>
                <div style="float:right; width:49.5%;height:40px; border:1px solid #eaeaea; background-color: #bf5329;">
                    <a href="/admin/productlist/find">用 户 寻 求</a></div>
            @endif
        </div>

        <div style="">
            <table border="0" class="order_tab" style="width:930px;" cellspacing="0" cellpadding="0">
                <tr style="max-height: 50px;">
                    <td align="center" width="275">商品名称</td>
                    <td align="center" width="500">详情</td>
                    <td align="center" width="100">状态</td>
                    <td align="center" width="150">操作</td>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td style="font-family:'宋体';text-align: left">
                            <div class="sm_img"><img src="/storage/{{$product['image'][0]}}"
                                                     onerror="this.src='/storage/99920a787050a10e9db6e5fe9d8bba49.jpg'"
                                                     width="48" height="48"/></div>
                            {{ $product['title'] }}<br/>
                            ￥{{ $product['price'] }}
                        </td>
                        <td align="center"><div id="des" class="des">{{ $product['description'] }}</div></td>
                        <td>
                            @if($product['status']==0)
                                @if($type=='sell')
                                    在售
                                @else
                                    寻求中
                                @endif
                            @else
                                @if($type=='sell')
                                    已下架
                                @else
                                    已撤回
                                @endif
                            @endif
                        </td>
                        <td align="center"><a href="/product/detail/{{ $product['id'] }}">详情</a>&nbsp; &nbsp; &nbsp;
                            &nbsp;
                            <a href="javascript:delProduct({{ $product['id'] }});">删除</a></td>
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
        </div>
    </div>

    <script>
        function delProduct(id) {
            $.get('/product/deleteNode/' + id, function (response) {
                if (response == 1) {
                    alert("删除成功！");
                    window.location.reload();
                }
            });
        }
    </script>
@endsection
