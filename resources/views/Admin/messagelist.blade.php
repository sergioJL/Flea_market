@extends('Admin.base')
@section('left')
    <li><a href="/admin/tobeprocess"><em></em><span>站内公告</span></a></li>
    <li><a href="/admin/userlist"><em></em><span>用户信息</span></a></li>
    <li><a href="/admin/productlist/sell"><em></em><span>商品信息</span></a></li>
    <li><a href="/admin/Messagelist" class="on"><em></em><span>留言信息</span></a></li>
@endsection


@section('right')
    <link href="/css/pagination.css" rel="stylesheet" type="text/css"/>
    <div style="height:800px;">
        <table border="0" class="order_tab" style="width:930px;" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" width="100">商品</td>
                <td align="center" width="75">留言人姓名</td>
                <td align="center" width="185">内容</td>
                <td align="center" width="50">操作</td>
            </tr>
            @foreach($Messages as $mes)
                <tr>
                    <td style="font-family:'宋体';text-align: left">
                        <div class="sm_img"><img src="/storage/{{ $mes['product']['image'][0]}}"
                                                 onerror="this.src='/storage/99920a787050a10e9db6e5fe9d8bba49.jpg'"
                                                 width="48" height="48"/></div>
                        {{ $mes['product']['title'] }}<br/>
                        ￥{{ $mes['product']['price'] }}
                    </td>

                        <td align="center">
                            {{ $mes['sender']['nickname'] }}({{ $mes['sender']['name'] }})
                        </td>
                        <td>{{ $mes['message'] }}</td>
                        <td align="center"><a href="javascript:delMesNode({{ $mes['id'] }});">删除</a></td>

                </tr>
            @endforeach
        </table>
        <div id="pull_right">
            <div class="pull-right">
                {!! $Messages->render() !!}
            </div>
        </div>
    </div>
    <script>
        function delMesNode(id) {
            console.log(id);
            $.get('/del/mes/'+id, function(response) {
                // handle your response here
                if (response==1)
                {
                    alert("删除成功！");
                    window.location.reload();
                }
            });
        }
    </script>
@endsection
