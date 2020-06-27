@extends('Admin.base')
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
    <form method="post" action="" class="form_gonggao">
        <input type="text" name="title" class="form-title" placeholder="标      题"><br><br><br>
        <textarea name="article-ckeditor"></textarea>
        {{ csrf_field() }}
        <br><br>
        <input type="submit" value="    发       表    " class="form-submit">
    </form>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' , { height: '545px' });
    </script>
@endsection
