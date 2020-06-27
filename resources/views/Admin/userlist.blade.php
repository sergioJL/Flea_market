@extends('Admin.base')
@section('left')
    <li><a href="/admin/tobeprocess"><em></em><span>站内公告</span></a></li>
    <li><a href="/admin/userlist" class="on"><em></em><span>用户信息</span></a></li>
    <li><a href="/admin/productlist/sell"><em></em><span>商品信息</span></a></li>
    <li><a href="/admin/Messagelist"><em></em><span>留言信息</span></a></li>
@endsection


@section('right')
    <link href="/css/pagination.css" rel="stylesheet" type="text/css"/>
    <div style="height:800px;">
        <table border="0" class="order_tab" style="width:930px;" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" width="100">学号</td>
                <td align="center" width="100">姓名</td>
                <td align="center" width="100">学院专业</td>
                <td align="center" width="100">联系方式</td>
                <td align="center" width="100">注册时间</td>
                <td align="center" width="150">操作</td>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td align="center">{{ $user['student_id'] }}</td>
                    <td align="center">{{ $user['name'] }}({{ $user['nickname'] }})</td>
                    <td align="center">{{ $user['college'] }}<br/>{{ $user['profession'] }}</td>
                    <td align="center">{{ $user['phone_num'] }}</td>
                    <td align="center">{{ $user['register_date'] }}</td>
                    <td align="center"><a href="javascript:delUserNode({{ $user['id'] }});">删除</a></td>
                </tr>
            @endforeach
        </table>
        <div id="pull_right">
            <div class="pull-right">
                {!! $users->render() !!}
            </div>
        </div>
    </div>
    <script>
        function delUserNode(id) {
            console.log(id);
            $.get('/del/user/'+id, function(response) {
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
