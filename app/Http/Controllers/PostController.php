<?php

namespace App\Http\Controllers;

use App\Constants\ErrorCode;
use App\Models\Comment;
use App\Models\Post;
use Brady\Tool\Exception\ExceptionResult;
use Brady\Tool\Response\Response;
use Brady\Tool\Upload\Oss;
use Illuminate\Http\Request;
use Illuminate\Log\LogManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Error;
use PhpParser\Node\Stmt\DeclareDeclare;
use Psr\Log\LoggerInterface;

class PostController extends Controller
{

	public function __construct()
	{

	}

	//列表页面
	public function index(Request $request)
	{
		$posts = Post::orderBy("created_at",'desc')->paginate(6);
		return view("post.index",compact('posts'));
	}

	//详情页面
	public function show(Post $post,LogManager $log)
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
		$post->user_id = Auth::id();
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

		try{
			if(Auth::id() !== $post->user_id){
				ExceptionResult::throwException(ErrorCode::NO_PERMISSION);
			}

			$params = $request->toArray();
			$post->title = $params['title'];
			$post->content = $params['content'];
			$post->user_id = Auth::id();
			$res = $post->save();

			if($res){
				Response::success('删除成功');
			} else {
				ExceptionResult::throwException(ErrorCode::ACTION_FAIL);
			}
		} catch (ExceptionResult $e){
			Response::error($e->getCode(),$e->getMessage());
		}
	}

	//删除
	public function delete(Post $post)
	{
		try{
			if(Auth::id() !== $post->user_id){
				ExceptionResult::throwException(ErrorCode::NO_PERMISSION);
		}
			$res = $post->delete();
			if($res){
				Response::success('删除成功');
			} else {
				ExceptionResult::throwException(ErrorCode::ACTION_FAIL);
			}
		} catch (ExceptionResult $e){
			Response::error($e->getCode(),$e->getMessage());
		}


	}

	public function comment(Post $post,Request $request)
	{
		try{
			if(empty($request->content)){
				ExceptionResult::throwException(ErrorCode::COMMENT_EMPTY);
			}

			$comment = new Comment();
			$comment->content = $request->content;
			$comment->user_id = Auth::id();
			$res = $post->comments()->save($comment);
			if($res){
				return  Redirect::back()->with('success', '评论成功');
			} else {
				ExceptionResult::throwException(ErrorCode::ACTION_FAIL);
			}

		}catch (ExceptionResult $e){

			return  Redirect::back()->with('error', $e->getMessage())->withInput();
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
		$res   = $oss->upload($request->file('wangEditorH5File'),"jianshu/content/".md5(time()).".jpg");

		if(!empty($res['oss-request-url'])){
			$arr = ['url'=>[$res['oss-request-url']]];
		} else {
			$arr = ['url'=>[]];
		}

		echo  json_encode($arr);
	}
}
