<?php
/**
 * Created by PhpStorm.
 * User: costa
 * Date: 2019/3/15
 * Time: 14:12
 */

namespace App\Providers;


use Brady\Tool\Exception\ExceptionResult;
use Illuminate\Support\ServiceProvider;

class ExceptionServiceProvider extends ServiceProvider
{
    /**
     *  注册编码信息
     */
    public function register()
    {
        $tpl = require (dirname(__DIR__) . '/Constants/ErrorMsg.php');
        ExceptionResult::setMsgTemplate($tpl);
    }
}