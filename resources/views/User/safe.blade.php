@extends('User.base2')
@section('main')

    <p></p>
    <div class="mem_tit">账户信息</div>
    <div class="m_des">
        <form id="changeNickName" method="post" action="/user/change/nickname">
            {{ csrf_field() }}
            <table border="0" style="width:880px;" cellspacing="0" cellpadding="0">
                <tr height="45">
                    <td width="80" align="right">新昵称 &nbsp; &nbsp;</td>
                    <td><input type="text" name="newnickname" value="" class="add_ipt" style="width:180px;"/>&nbsp; <font
                            color="#ff4e00">*</font></td>
                </tr>
                <tr height="50">
                    <td>&nbsp;</td>
                    <td><input type="submit" value="确认修改" class="btn_tj"/></td>
                </tr>
            </table>
        </form>
    </div>

    <div class="m_des">
        <form action="/user/change/phonenum" method="post">
            {{ csrf_field() }}
            <table border="0" style="width:880px;" cellspacing="0" cellpadding="0">
                <tr height="45">
                    <td width="80" align="right">原手机 &nbsp; &nbsp;</td>
                    <td><input type="text" name="old_phonenum" value="" class="add_ipt" style="width:180px;"/>&nbsp; <font
                            color="#ff4e00">*</font></td>
                </tr>
                <tr height="45">
                    <td align="right">新手机 &nbsp; &nbsp;</td>
                    <td><input type="text" name="new_phonenum" value="" class="add_ipt" style="width:180px;"/>&nbsp; <font
                            color="#ff4e00">*</font></td>
                </tr>
                <tr height="50">
                    <td>&nbsp;</td>
                    <td><input type="submit" value="确认修改" class="btn_tj"/></td>
                </tr>
            </table>
        </form>
    </div>

    <div class="mem_tit">账户安全</div>
    <div class="m_des">
        <form action="/user/change/psd" method="post">
            {{ csrf_field() }}
            <table border="0" style="width:880px;" cellspacing="0" cellpadding="0">
                <tr height="45">
                    <td width="80" align="right">原密码 &nbsp; &nbsp;</td>
                    <td><input type="password" name="old_psd" value="" class="add_ipt" style="width:180px;"/>&nbsp; <font
                            color="#ff4e00">*</font></td>
                </tr>
                <tr height="45">
                    <td align="right">新密码 &nbsp; &nbsp;</td>
                    <td><input type="password" name="new_psd" value="" class="add_ipt" style="width:180px;"/>&nbsp; <font
                            color="#ff4e00">*</font></td>
                </tr>
                <tr height="45">
                    <td align="right">确认密码 &nbsp; &nbsp;</td>
                    <td><input type="password" name="new_psd2" value="" class="add_ipt" style="width:180px;"/>&nbsp; <font
                            color="#ff4e00">*</font></td>
                </tr>
                <tr height="50">
                    <td>&nbsp;</td>
                    <td><input type="submit" value="确认修改" class="btn_tj"/></td>
                </tr>
            </table>
        </form>
    </div>
    @if (count($errors) > 0)
        <?php
        $str_error = '';
        foreach ($errors->all() as $error) {
            $str_error = $str_error . $error . '\n';
        }
        $errors = null;
        echo "<script>alert('$str_error');</script>";
        ?>
    @endif
@endsection
