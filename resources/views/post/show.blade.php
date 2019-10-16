
@extends("layout.main")

@section("content")
    <style>
        .list-group{
            margin-bottom:10px;
        }
    </style>
    <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                    <h2 class="blog-post-title">{!! str_limit($post->title,500,'...') !!}</h2>
                    @if( !empty(\Auth::id()) && \Auth::id() == $post->user_id )
                    <a style="margin: auto"  href="/posts/{{ $post->id }}/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a style="margin: auto" class="delete"  href="javascript:void(0);" data-id="{{ $post->id }}">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    @endif
                </div>

                <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} by <a href="#">{{ $post->user->name }}</a></p>

                <p>{!! $post->content !!}</p>
                <div>
                    <a href="/posts/{{ $post->id }}/zan" type="button" class="btn btn-primary btn-lg">赞</a>

                </div>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">评论</div>

                <!-- List group -->
                @if(!empty($post->comments))
                    @foreach($post->comments as $item)
                        <ul class="list-group" style="padding-bottom:10px;">
                            <li class="list-group-item">
                                <h5>{{ $post->created_at }} by {{ $item->user->name }}</h5>
                                <div>
                                    {{ $item->content }}
                                </div>
                            </li>
                        </ul>
                    @endforeach
                    @endif


            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">发表评论</div>

                <!-- List group -->
                <ul class="list-group">
                    <form action="/posts/{{ $post->id }}/comment" method="POST">
                        {{ csrf_field() }}
                        <li class="list-group-item">
                            <textarea name="content" class="form-control" rows="10"></textarea>
                            @if (session('error'))
                                <div class="alert alert-danger small">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success small">
                                    {{ session('success') }}
                                </div>
                            @endif
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
                                layer.msg("删除成功", {"icon": 1})
                                setTimeout("location.href='/posts'",2000)
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
