@extends("layout.main")

@section("content")

        <div class="col-sm-8 blog-main">
            <form class="form-horizontal" action="/user/me/setting" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="name" type="text" value="{{ !empty(old('name')) ? old('name') : $user->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">头像</label>
                    <div class="col-sm-2">
                        <img  id="preview_img" src="{{ !empty($user->avatar) ? $user->avatar : '' }}" alt="" class="img-rounded" style="border-radius:500px; width:100px;heigith:100px;">
                        <input class=" file-loading preview_input" type="file" value="用户名" style="width:72px" id="avatar" name="avatar" onchange="mypit()">

                    </div>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <button type="submit" class="btn btn-default">提交</button>
            </form>
            <br>

        </div>

        <script>
            function mypit() {

                var myfiles = document.getElementById("avatar"); //获取点击按钮的对象

                var url = '';

                url = window.URL.createObjectURL(myfiles.files[0]); //获取forms中的文件，并赋值给url，每次调用URL.crreateObjectURl方法时，都会创建一个对象。

                document.getElementById("preview_img").src = url; //获取img标签对象的src，并将url赋值给img标签的src属性，这是完成打印的一步。

            }
        </script>

@endsection