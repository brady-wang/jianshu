<?php
namespace App\Constants;

use App\Constants\ErrorCode;
return [
	ErrorCode::SUCCESS      => '成功' ,
	ErrorCode::UNAUTHORIZED => '暂无权限！' ,
	ErrorCode::FAIL         => '失败' ,

	ErrorCode:: USER_NOT_EMPTY        => '用户名不能为空' ,
	ErrorCode::PASSWORD_NOT_EMPTY         => '请输入密码' ,
	ErrorCode::PASSWORD_RE_NOT_EMPTY         => '请再次输入密码',
	ErrorCode::EMAIL_NOT_EMPTY         => '邮箱不能为空',

];