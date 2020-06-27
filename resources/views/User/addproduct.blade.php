@extends('User.base2')
@section('head')
    <script type="text/javascript" src="/js/jquery-3.5.0.min.js"></script>
@endsection
@section('main')
    <div style="margin: 50px 100px auto;font-size: 18px;">
        <form action="" method="post" enctype="multipart/form-data">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr height="50" valign="top">
                    <td width="80">标&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;题：</td>
                    <td width="800">
                        <input type="text" name="title" value="" style="font-size: 20px;">
                        <span class="warning_psd"
                              style="color: #ff0000;font-size: 9px;">{{ $errors->first('title') }}</span>
                    </td>
                </tr>
                <tr height="50">
                    <td>添加标签：</td>
                    <td>
                        <div id="p_label" class="p_label" style="width: 375px; float: left;"></div>
                        <input id="1D_label" type="button" onclick="add_label()" value="添加" style="width: 70px;">
                        <span class="warning_psd"
                              style="color: #ff0000;font-size: 9px;">{{ $errors->first('p_label') }}</span>
                    </td>
                </tr>
                <tr height="50">
                    <td>价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：</td>
                    <td><input type="text" name="price" oninput="value=value.replace(/[^\d]/g,'')" placeholder="￥0.00"
                               style="text-align: right;font-size: 20px;">
                        <span class="warning_psd"
                              style="color: #ff0000;font-size: 9px;">{{ $errors->first('price') }}</span>
                    </td>
                </tr>
                <tr height="50">
                    <td>添加图片：</td>
                    <td><input type="file" name="avatar[]" multiple="multiple">
                        <span class="warning_psd"
                              style="color: #ff0000;font-size: 9px;">{{ $errors->first('avatar') }}</span>
                    </td>
                </tr>
                <tr height="50">
                    <td>详细描述：</td>
                    <td><textarea name="detailed_description" placeholder="请添加商品的详细描述，最多200字"
                                  style="resize:none;width:600px;height:200px;"></textarea><br>
                        <span class="warning_psd"
                              style="color: #ff0000;font-size: 9px;">{{ $errors->first('detailed_description') }}</span>
                    </td>
                </tr>
                <tr height="50">
                    <td colspan="2" style="text-align: center;"><input type="submit" value="发    布"
                                                                       style="width: 100px;font-size: 16px;"></td>
                </tr>
            </table>
            {{csrf_field()}}
        </form>
    </div>

    <script>
        function add_label() {
            var label_arr = ["电脑数码", "运动户外", "服饰鞋包", "个护化妆", "日用百货",
                "配饰腕表", "图书影像", "玩模乐器", "办公设备", "其他"];
            var str = '';
            label_arr.forEach(function (label) {
                str = str + "<input type='checkbox' id='first_level_label' value='" + label + "' >" + label;
            })
            str = str + "<input onclick='show_1dlabel()' value='确定' type='button'>";
            //先保存div中原来的html
            //var tag = document.getElementById("p_label").innerHTML;
            //再跟你想追加的代码加到一起插入div中
            document.getElementById("1D_label").remove();
            document.getElementById("p_label").innerHTML = str;
        }

        var arr_1dlabel = new Array();

        function show_1dlabel() {
            var values = new Array();
            <!--清空数组-->
            values.splice(0, values.length);
            $("input[type='checkbox'][id='first_level_label']").each(function () {
                if ($(this).is(":checked")) {
                    <!--向数组内添加新元素-->
                    values.push($(this).val());
                }
            });
            arr_1dlabel = values;
            //alert(values);
            document.getElementById("p_label").innerHTML = values +
                "<br><input id=\"1D_label\" type=\"button\" onclick=\"add_2dlabel()\" value=\"添加\"\n" +
                " style=\"width: 70px;;\">添加二级标签";

        }

        function add_2dlabel() {
            var label2d_arr = {
                "电脑数码": ["手机", "电脑", "智能手表", "相机", "配件"],
                "运动户外": ["运动服饰", "户外装备", "运动器材"],
                "服饰鞋包": ["男装", "女装", "男鞋", "女鞋", "男包", "女包", "箱包"],
                "个护化妆": ["男士", "女士", "面部护理", "身体护肤"],
                "日用百货": [],
                "配饰腕表": ["钟表", "珠宝"],
                "图书影像": ["电子书刊", "音像制品", "音乐影视", "经济管理",
                    "文化艺术", "少儿读物", "流行娱乐", "文学诗歌", "生活教育", "科学技术",
                    "期刊杂志", "工具书漫画"
                ],
                "玩模乐器": ["玩具", "模型", "二次元周边", "乐器"],
                "办公设备": ["办公仪器", "文具用品"],
                "其他": []
            }
            var label_arr = [];
            //console.log(arr_1dlabel);
            arr_1dlabel.forEach(function (label) {
                label_arr.push.apply(label_arr, label2d_arr[label]);
            });
            var str = '';
            label_arr.forEach(function (label) {
                str = str + "<input type='checkbox' id='second_level_label' value='" + label + "' >" + label;
            })
            //var old = document.getElementById("p_label").innerHTML;
            document.getElementById("p_label").innerHTML = arr_1dlabel + '<br>' + str
                + "<input onclick='getlabel()' value='确定' type='button'>";
        }

        var arr_2dlabel = new Array();

        function getlabel() {
            var values = new Array();
            <!--清空数组-->
            values.splice(0, values.length);
            $("input[type='checkbox'][id='second_level_label']").each(function () {
                if ($(this).is(":checked")) {
                    <!--向数组内添加新元素-->
                    values.push($(this).val());
                }
            });
            arr_2dlabel = arr_1dlabel.concat(values);
            var str = '';
            arr_2dlabel.forEach(function (label) {
                str = str + "<input type='text' name='plabel[]' readonly='readonly' size='4' value='" + label + "' style='font-size: 18px; text-align: center; border: 0; outline: none; background-color: rgba(0, 0, 0, 0);'> ";
            });
            document.getElementById("p_label").innerHTML = str;
        }
    </script>
@endsection

