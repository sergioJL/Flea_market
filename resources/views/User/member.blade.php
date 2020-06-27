@extends('User.base2')
@section('main')
    <div class="m_des">
        <table border="0" style="width:870px; line-height:22px;" cellspacing="0" cellpadding="0">
            <tr valign="top">
                <td width="115"><img src="/images/avatar.png" width="90" height="90"/></td>
                <td>
                    <div class="m_user">{{ $user['nickname'] }}</div>
                    <p>
                        您已注册使用该系统 {{ ceil((strtotime(date('Y-m-d'))-strtotime($user['register_date']))/86400)  }}天！
                    </p>
                    <div class="m_notice">
                        用户中心公告！
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="mem_t">网站操作信息</div>
    <table border="0" class="mon_tab" style="width:870px; margin-bottom:20px;" cellspacing="0" cellpadding="0">
        <tr>
            <td width="33%">我的收藏：<span style="color:#ff3200;">{{ $product_likenum }} 件</span></td>
            <td width="33%">我发布的：<span style="color:#ff3200;">{{ $product_num }} 件</span></td>
            <td width="33%"></td>
        </tr>
        <tr>
            <td>留言：<span> {{ $mes_num }} 条</span></td>
        </tr>
    </table>

    <div class="mem_t">账号信息</div>
    <table border="0" class="acc_tab" style="width:870px;" cellspacing="0" cellpadding="0">
        <tr>
            <td class="td_l">学  号：</td>
            <td>{{ $user['student_id'] }}</td>
        </tr>
        <tr>
            <td class="td_l b_none">真实姓名：</td>
            <td>{{ $user['name'] }}</td>
        </tr>
        <tr>
            <td class="td_l b_none">电 话：</td>
            <td>{{ $user['phone_num'] }}</td>
        </tr>
        <tr>
            <td class="td_l">所在学院：</td>
            <td>{{ $user['college'] }}</td>
        </tr>
        <tr>
            <td class="td_l b_none">所在专业：</td>
            <td>{{ $user['profession'] }}</td>
        </tr>
        <tr>
            <td class="td_l b_none">注册日期：</td>
            <td>{{ $user['register_date'] }}</td>
        </tr>
    </table>
@endsection

