
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

    <title>注册</title>

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

    <div class="form-signin" >
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
        <h2 class="form-signin-heading">请注册</h2>
        <div>
            <label for="name" class="sr-only">用户名</label>
            <input v-model="form.name" type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="用户名"   autofocus style="margin-bottom:10px;">
            <label  class="sr-only">密码</label>
            <input v-model="form.password" type="password" name="password" id="inputPassword" autocomplete="off" class="form-control"  placeholder="输入密码" >

            <label class="sr-only" >重复密码</label>
            <input v-model="form.password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="重复输入密码" >

            <button class="btn btn-lg btn-primary btn-block" type="submit" @click="registor">注册</button>
        </div>

    </div>

</div> <!-- /container -->

<script>
    var app = new Vue({
        el: '#app',
        data: {
            form:{
                name:'',
                password:'',
                password_confirmation:'',
                _token:''
            }
        },
        methods:{
            registor:function(){
                this.form._token = $("#_token").val()
                axios.post('/register', this.form)
                    .then(function (response) {
                        var res = response.data;
                        if(res.code != 200){
                            layer.msg(res.msg,{icon:2});
                            console.log(res.msg )
                            return
                        } else {
                            layer.msg("注册成功",{icon:1});
                            setTimeout("location.href='/login'",2000);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    })
</script>
</body>
</html>
