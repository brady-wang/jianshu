@extends("layout.main")

@section("content")
    <div class="col-sm-8 blog-main">
            <div>
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="id" value="{{ $post->id }}">
                <div class="form-group">
                    <label>标题</label>
                    <input id="title" type="text"  class="form-control" placeholder="这里是标题" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <div id="content">
                        {!! $post->content  !!}
                    </div>
                </div>
                <button type="submit"  id="edit" class="btn btn-default">提交</button>
            </div>
            <br>
        </div><!-- /.blog-main -->

    <script>
        $(function(){
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



            editor.customConfig.customAlert = function (info) {
                // info 是需要提示的内容
                layer.msg(info)
            }

            editor.customConfig.uploadImgHooks = {
                before: function (xhr, editor, files) {
                    // 图片上传之前触发
                    // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，files 是选择的图片文件

                    // 如果返回的结果是 {prevent: true, msg: 'xxxx'} 则表示用户放弃上传
                    // return {
                    //     prevent: true,
                    //     msg: '放弃上传'
                    // }
                },
                success: function (xhr, editor, result) {
                    // 图片上传并返回结果，图片插入成功之后触发
                    // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
                },
                fail: function (xhr, editor, result) {
                    // 图片上传并返回结果，但图片插入错误时触发
                    // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
                },
                error: function (xhr, editor) {
                    // 图片上传出错时触发
                    // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
                },
                timeout: function (xhr, editor) {
                    // 图片上传超时时触发
                    // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
                },

                // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
                // （但是，服务器端返回的必须是一个 JSON 格式字符串！！！否则会报错）
                customInsert: function (insertImg, result, editor) {
                    // 图片上传并返回结果，自定义插入图片的事件（而不是编辑器自动插入图片！！！）
                    // insertImg 是插入图片的函数，editor 是编辑器对象，result 是服务器端返回的结果
                    console.log(result)
                    // 举例：假如上传图片成功后，服务器端返回的是 {url:'....'} 这种格式，即可这样插入图片：
                    var url = result.url
                    insertImg(url)

                    // result 必须是一个 JSON 格式字符串！！！否则报错
                }
            }

            editor.create()

            $("#edit").click(function(){
                var id = $("#id").val();
                var title = $.trim($("#title").val())
                var content = editor.txt.html()

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

                console.log(data);

                $.ajax({
                    type: 'put',
                    url: '/posts/'+id+'/update',
                    data: data,
                    dataType: "json",
                    success: function (res) {

                        if (res.code == 200) {
                            layer.msg("编辑成功", {"icon": 1})
                            setTimeout("location.href='/posts/detail/"+id+"'")
                        } else {
                            layer.msg(res.msg, {"icon": 2})
                        }


                    }
                })

            })

        })
    </script>
@endsection
