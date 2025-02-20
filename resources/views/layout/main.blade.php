
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="referrer" content="no-referrer" />
    <meta name="csrf-token" content="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>简书</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="/Home/css/blog.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/lib/wangEditor/wangEditor.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>



    <![endif]-->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/lib/jquery/jquery-2.2.1.js"></script>
    <script src="/lib/layer/layer.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/lib/wangEditor/wangEditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="/Home/js/wys.js"></script>
</head>

<body>

@include("layout.nav")
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">
        @yield("content")

        @include("layout.siderbar")
    </div>    </div><!-- /.row -->
</div><!-- /.container -->

@include("layout.footer")

</body>
</html>
