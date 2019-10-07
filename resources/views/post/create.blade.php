@extends("layout.main")

@section("content")
    <div class="col-sm-8 blog-main" id="app">
        <div>
            <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <label>标题</label>
                <input name="title" id="title" type="text" class="form-control" placeholder="这里是标题">
            </div>
            <div class="form-group">
                <label>内容</label>
                <div id="content">

                </div>
            </div>
            <input type="button" id = "createUser" class="btn btn-default" value="提交"/>
        </div>
        <br>

    </div><!-- /.blog-main -->



    <script>
        $(function () {
            $("#title").focus();

            var E = window.wangEditor
            var editor = new E('#content')
            editor.customConfig.uploadImgServer = '/posts/image/upload'
            editor.customConfig.uploadImgHeaders = {
                'X-CSRF-TOKEN': $("#_token").val()
            }

            editor.customConfig.menus = [

                'head',  // 标题
                'bold',  // 粗体
                'fontSize',  // 字号
                'fontName',  // 字体
                'italic',  // 斜体
                'underline',  // 下划线
                'strikeThrough',  // 删除线
                'foreColor',  // 文字颜色
                'backColor',  // 背景颜色
                'link',  // 插入链接
                'list',  // 列表
                'justify',  // 对齐方式
                'emoticon',  // 表情
                'image',  // 插入图片
                'table',  // 表格
                'code',  // 插入代码
            ]

            editor.customConfig.uploadFileName = 'wangEditorH5File'
            editor.create()

            $("#createUser").click(function(){
                var title = $.trim($("#title").val());
                var content = $.trim(editor.txt.html());

                if ($.trim(title).length <= 0) {
                    layer.msg("请输入标题", {"icon": 2});
                    return;
                }

                if ($.trim(content).length <= 0) {
                    layer.msg("请输入内容", {"icon": 2});
                    return;
                }

                var data = {};

                data._token = $("#_token").val();
                data.title = title;
                data.content = content;

                $.ajax({
                    type: 'post',
                    url: '/posts',
                    data: data,
                    dataType: "json",
                    success: function (res) {

                        if (res.code == 200) {
                            layer.msg("添加成功", {"icon": 1})
                            setTimeout("location.href='/posts'")
                        } else {
                            layer.msg(res.msg, {"icon": 2})
                        }


                    }
                })
            })



        })
    </script>
@endsection