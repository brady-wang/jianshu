<?php
namespace App\Constants;

use App\Constants\ErrorCode;
return [
	ErrorCode::SUCCESS      => '成功' ,
	ErrorCode::UNAUTHORIZED => '暂无权限！' ,
	ErrorCode::FAIL         => '失败' ,
	ErrorCode::ACTION_FAIL         => '操作失败' ,

	ErrorCode:: USER_NOT_EMPTY        => '用户名不能为空' ,
	ErrorCode::PASSWORD_NOT_EMPTY         => '请输入密码' ,
	ErrorCode::PASSWORD_RE_NOT_EMPTY         => '请再次输入密码',
	ErrorCode::EMAIL_NOT_EMPTY         => '邮箱不能为空',
	ErrorCode::PASSWORD_RE_NOT_SAME         => '两次输入密码不一致   ',
	ErrorCode::USER_EXISTS         => '用户已存在',
	ErrorCode::LOGIN_FAILED         => '登录失败',
	ErrorCode::NO_PERMISSION         => '无权限',
	ErrorCode::COMMENT_EMPTY         => '请输入评论内容',

];