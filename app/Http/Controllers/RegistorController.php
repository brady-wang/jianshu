<?php

namespace App\Http\Controllers;

use App\Constants\ErrorCode;
use Brady\Tool\Exception\ExceptionResult;
use Brady\Tool\Response\Response;
use Illuminate\Http\Request;

class RegistorController extends Controller
{

	public function index()
	{

		try{
			//ExceptionResult::throwException(ErrorCode::USER_NOT_EMPTY);
			Response::success(['name'=>'wang']);
		} catch (ExceptionResult $e){
			echo Response::error($e->getCode(),$e->getMessage());
		}

		return view('registor/index');
	}

	public function registor()
	{
		ExceptionResult::throwException("sdfsdfsf",true);
	}
}
