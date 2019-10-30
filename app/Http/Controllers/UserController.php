<?php

namespace App\Http\Controllers;

use App\Constants\ErrorCode;
use Brady\Tool\Exception\ExceptionResult;
use Brady\Tool\Upload\Oss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
		return view("user/index");
    }

    public function setting()
    {
    	$user = Auth::user();
		return view("user/setting",compact('user'));
    }

    public function settingUser(Request $request)
    {
		$name = $request->input('name');
		try{
			if(empty($name)){
				ExceptionResult::throwException(ErrorCode::USER_NOT_EMPTY);
			}

			$userExists = User::where('name',$name)->first();
			if(!empty($userExists) && $userExists->id != \Auth::id()){
				ExceptionResult::throwException(ErrorCode::USER_EXISTS);
			}


			$user = \Auth::user();
			if(!empty($request->file('avatar'))){
				$avatar = $this->uploadAvatar($request);
				if(!empty($avatar)){
					$user->avatar = $avatar;
				}
			}


			$user->name = $name;
			$user->save();

			return redirect('/user/me/setting')->with('success', '修改成功');




		} catch (ExceptionResult $e) {
			return  Redirect::back()->with('error', $e->getMessage())->withInput();
		}
    }

    public function uploadAvatar($request)
    {

	    $config = [
		    'accessKeyId'=>env("accessKeyId"),
		    'accessKeySecret'=>env("accessKeySecret"),
		    'endpoint'=>env("endpoint"),
		    'bucket'=>env("bucket"),
	    ];

	    $oss = new Oss($config);
	    $res   = $oss->upload($request->file('avatar'),"jianshu/avatar/".md5(time()).".jpg");

		return isset($res['oss-request-url']) ? $res['oss-request-url'] : '';

    }
}
