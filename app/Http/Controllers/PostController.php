<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\DeclareDeclare;

class PostController extends Controller
{

	//列表页面
	public function index()
	{
		$posts = Post::orderBy("created_at",'desc')->paginate(2);
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
	public function delete($id)
	{
		$res = Post::where('id',$id)->delete();
		if($res){
			echo json_encode(['code'=>200,'msg'=>'删除成功']);
		} else {
			echo json_encode(['code'=>500,'msg'=>'删除失败']);
		}

	}

	public function upload(Request $request)

	{
		$path=$request->file('wangEditorH5File')->storePublicly(md5(time()));
		$file = asset('storage/'.$path);//返回生成的文件的完整路径：
		$arr = ['url'=>["https://pics6.baidu.com/feed/b7fd5266d0160924e13faec61917bbffe7cd34ee.jpeg?token=c8e65488aa4d17020b1444fd55f7a1c5&s=BC586E9648134EDA18BB38EB0300E02A"]];
		return json_encode($arr);
	}
}
