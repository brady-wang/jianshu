<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Brady\Tool\Upload\Oss;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\DeclareDeclare;

class PostController extends Controller
{

	//列表页面
	public function index()
	{

		$posts = Post::orderBy("created_at",'desc')->paginate(6);
		return view("post.index",compact('posts'));
	}

	//详情页面
	public function show(Post $post)
	{
		return view("post.show",compact('post'));
	}

	//新增页面
	public function create()
	{
		return view("post.create");
	}



	//保存新增
	public function store(Request $request)
	{
		$data = $request->toArray();
		$post = new Post();
		$post->title = $data['title'];
		$post->content = $data['content'];
		$res = $post->save();
		if($res){
			echo json_encode(['code'=>200,'msg'=>'success']);
		} else {
			echo json_encode(['code'=>500,'msg'=>'新增失败']);
		}

	}

	//编辑页面
	public function edit(Post $post)
	{
		return view("post.edit",compact("post"));
	}

	//更新操作
	public function update(Post $post,Request $request)
	{
		//todo 用户权限
		$params = $request->toArray();
		$post->title = $params['title'];
		$post->content = $params['content'];
		$res = $post->save();
		if($res){
			echo json_encode(['code'=>200,'msg'=>'success']);
		} else {
			echo json_encode(['code'=>500,'msg'=>'编辑失败']);
		}
	}

	//删除
	public function delete(Post $post)
	{
		// todo 用户权限
		$res = $post->delete();
		if($res){
			echo json_encode(['code'=>200,'msg'=>'删除成功']);
		} else {
			echo json_encode(['code'=>500,'msg'=>'删除失败']);
		}

	}

	public function upload(Request $request)

	{
		$config = [
			'accessKeyId'=>env("accessKeyId"),
			'accessKeySecret'=>env("accessKeySecret"),
			'endpoint'=>env("endpoint"),
			'bucket'=>env("bucket"),
		];

		$oss = new Oss($config);
		$res   = $oss->upload($request->file('wangEditorH5File'),"jianshu/".md5(time()).".jpg");

		if(!empty($res['oss-request-url'])){
			$arr = ['url'=>[$res['oss-request-url']]];
		} else {
			$arr = ['url'=>[]];
		}

		echo  json_encode($arr);
	}
}
