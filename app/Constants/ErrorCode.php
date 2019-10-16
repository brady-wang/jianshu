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
	const ACTION_FAIL = 505;


	const USER_NOT_EMPTY = 10001;
	const PASSWORD_NOT_EMPTY = 10002;
	const PASSWORD_RE_NOT_EMPTY = 10003;
	const EMAIL_NOT_EMPTY = 10004;
	const PASSWORD_RE_NOT_SAME = 10005;
	const USER_EXISTS = 10006;
	const LOGIN_FAILED = 10007;
	const NO_PERMISSION = 10008;
	const COMMENT_EMPTY = 10009;
}