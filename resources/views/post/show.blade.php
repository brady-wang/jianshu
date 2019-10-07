
@extends("layout.main")

@section("content")
    <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                    <h2 class="blog-post-title">{{ $post->title }}</h2>
                    <a style="margin: auto"  href="/posts/{{ $post->id }}/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a style="margin: auto" class="delete"  href="javascript:void(0);" data-id="{{ $post->id }}">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                </div>

                <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} by <a href="#">Kassandra Ankunding2</a></p>

                <p>{!! $post->content !!}</p>
                <div>
                    <a href="/posts/{{ $post->id }}/zan" type="button" class="btn btn-primary btn-lg">赞</a>

                </div>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">评论</div>

                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <h5>2017-05-28 10:15:08 by Kassandra Ankunding2</h5>
                        <div>
                            这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论
                        </div>
                    </li>
                </ul>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">发表评论</div>

                <!-- List group -->
                <ul class="list-group">
                    <form action="/posts/comment" method="post">
                        <input type="hidden" name="_token" value="4BfTBDF90Mjp8hdoie6QGDPJF2J5AgmpsC9ddFHD">
                        <input type="hidden" name="post_id" value="62"/>
                        <li class="list-group-item">
                            <textarea name="content" class="form-control" rows="10"></textarea>
                            <button class="btn btn-default" type="submit">提交</button>
                        </li>
                    </form>

                </ul>
            </div>

        </div><!-- /.blog-main -->

    <script>
        $(function(){
            $(".delete").click(function(){

                var id = $(this).attr('data-id');

                layer.confirm('确定删除？', {
                    btn: ['确定','取消'] //按钮
                }, function(){

                    var data = {};
                    data._token = $("#_token").val();

                    $.ajax({
                        type: 'post',
                        url: '/posts/delete/'+id,
                        data:data,
                        dataType: "json",
                        success: function (res) {
                            if (res.code == 200) {
                                layer.msg(res.msg, {"icon": 1})
                                setTimeout("location.href='/posts'")
                            } else {
                                layer.msg(res.msg, {"icon": 2})
                            }


                        }
                    })
                }, function(){

                });


            })
        })
    </script>
@endsection
