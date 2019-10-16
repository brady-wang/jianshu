<?php

namespace App\Http\Controllers;

use App\Constants\ErrorCode;
use Brady\Tool\Exception\ExceptionResult;
use Brady\Tool\Response\Response;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{

	public function index()
	{

		return view('register/index');
	}

	public function register(Request $request)
	{
		try{

			$data = $request->input();
			if(empty($data['name'])){
				ExceptionResult::throwException(ErrorCode::USER_NOT_EMPTY);
			}

			if(empty($data['password'])){
				ExceptionResult::throwException(ErrorCode::PASSWORD_NOT_EMPTY);
			}

			if(empty($data['password_confirmation'])){
				ExceptionResult::throwException(ErrorCode::PASSWORD_RE_NOT_EMPTY);
			}
			if($data['password'] != $data['password_confirmation']){
				ExceptionResult::throwException(ErrorCode::PASSWORD_RE_NOT_SAME);
			}

			$user = new User();

			$userExists = $user->where('name',$data['name'])->first();
			if(!empty($userExists)){
				ExceptionResult::throwException(ErrorCode::USER_EXISTS);
			}

			$user->name  = $data['name'];
			$user->password = bcrypt($data['password']);
			$user->save();
			Response::success($user);

		} catch (ExceptionResult $e){
			Response::error($e->getCode(),$e->getMessage());
		}
	}
}
