
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>登陆</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://v3.bootcss.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">


    <script src="/lib/jquery/jquery-2.2.1.js"></script>
    <script src="/lib/layer/layer.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container" id="app">

    <form class="form-signin" method="POST" action="/login">
        {{csrf_field()}}
        <h2 class="form-signin-heading">请登录</h2>
        <label for="inputName" class="sr-only">用户名</label>
        <input v-model="form.name" autocomplete="off" type="text" value="{{ old("name") }}" name="name" id="inputName" class="form-control" placeholder="用户民"  autofocus>
        <label for="inputPassword" class="sr-only">密码</label>
        <input v-model="form.password"  autocomplete="off" type="password" value="{{ old('password') }}" name="password" id="inputPassword" class="form-control" placeholder="密码" >
        <div class="checkbox">
            <label>
                <input v-model="form.is_remember"  type="checkbox" value="{{ old('is_remember') }}" name="is_remember"> 记住我
            </label>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <button class="btn btn-lg btn-primary btn-block" type="submit"  id="login">登陆</button>
        <a href="/register" class="btn btn-lg btn-primary btn-block" type="submit">去注册>></a>
    </form>

</div> <!-- /container -->


<script>

    $(document).keyup(function(event){
        if(event.keyCode ==13){
            $("#login").trigger("click");
        }
    });
//    var app = new Vue({
//        el: '#app',
//        data: {
//            form:{
//                name:'',
//                password:'',
//                _token:'',
//                is_remember:0
//            }
//        },
//        methods:{
//            login:function(){
//                this.form._token = $("#_token").val()
//                axios.post('/login', this.form)
//                    .then(function (response) {
//                        var res = response.data;
//                        if(res.code != 200){
//                            layer.msg(res.msg,{icon:2});
//                            console.log(res.msg )
//                            return
//                        } else {
//                            layer.msg("登录成功",{icon:1});
//                            setTimeout("location.href='/posts'",2000);
//                        }
//                    })
//                    .catch(function (error) {
//                        console.log(error);
//                    });
//            }
//        }
//    })
</script>
</body>
</html>
