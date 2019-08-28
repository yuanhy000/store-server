<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/17
 * Time: 23:52
 */

namespace App\Exceptions;

class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '你没有权限访问该接口，快走开';
    public $errorCode = 10001;
}