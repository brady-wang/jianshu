<?php

namespace App\Constants;

class ErrorCode
{
	/**
	 * 基本错误码
	 */
	const SUCCESS = 200;
	const UNAUTHORIZED = 401;
	const FAIL = 500;


	const USER_NOT_EMPTY = 10001;
	const PASSWORD_NOT_EMPTY = 10002;
	const PASSWORD_RE_NOT_EMPTY = 10003;
	const EMAIL_NOT_EMPTY = 10004;
}