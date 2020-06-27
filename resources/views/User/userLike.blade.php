@extends('User.base2')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="/js/jquery-1.11.1.min_044d0927.js"></script>
@endsection
@section('main')
    <p></p>
    <div class="mem_tit">
        <span class="fr" style="font-size:12px; color:#55555; font-family:'宋体'; margin-top:5px;">共发现{{ count($products) }}件</span>我的收藏
    </div>
    <table border="0" class="order_tab" style="width:930px;" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" width="420">商品名称</td>
            <td align="center" width="180">价格</td>
            <td align="center" width="270">操作</td>
        </tr>
        @foreach($products as $product)
        <tr>
            <td style="font-family:'宋体';">
                <div class="sm_img"><img src="/storage/{{$product['image'][0]}}" onerror="this.src='/storage/99920a787050a10e9db6e5fe9d8bba49.jpg'" width="48" height="48"/></div>
                {{ $product['title'] }}
            </td>
            <td align="center">￥{{ $product['price'] }}</td>
            <td align="center"><a href="/product/detail/{{ $product['id'] }}">详情</a>&nbsp; &nbsp; &nbsp; &nbsp; <a href="javascript:delete_like({{ $product['id'] }});">删除</a></td>
        </tr>
        @endforeach
    </table>
    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        function delete_like(id) {
            console.log("onclick");
            $.get('/product/deleteIwantProduct/' + id, function (response) {
                console.log(response);
                if (response == 1) {
                    alert('修改成功');
                    window.location.reload();
                } else {
                    alert('操作失败，请稍后再试');
                }
            })
        }
    </script>
@endsection
