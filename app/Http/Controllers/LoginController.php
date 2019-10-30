<?php

namespace App\Http\Controllers;

use App\Constants\ErrorCode;
use Brady\Tool\Data\Deal;
use Brady\Tool\Exception\ExceptionResult;
use Brady\Tool\Response\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
	public function index()
	{
		if(Auth::check()){
			return \redirect('/posts');
		}
		return view('login/index');
	}

	public function login(Request $request)
	{

		$data = $request->input();
		$data = Deal::trim($data);

		$name = $data['name'];
		$password = $data['password'];


		try{
			if(empty($name)){
				ExceptionResult::throwException(ErrorCode::USER_NOT_EMPTY);
			}

			if(empty($password)){
				ExceptionResult::throwException(ErrorCode::PASSWORD_NOT_EMPTY);
			}

			$is_remeber = boolval(isset($data['is_remember']));
			if(Auth::attempt(['name'=>$name,'password'=>$password],$is_remeber)) {
				return redirect('/posts');
			} else {
				ExceptionResult::throwException(ErrorCode::LOGIN_FAILED);
			}


		} catch (ExceptionResult $e){
			return  Redirect::back()->with('error', $e->getMessage())->withInput();
		}
	}

	public function logout()
	{
		Auth::logout();
		return redirect('/login');
	}
}
