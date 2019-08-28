<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/21
 * Time: 22:50
 */

namespace App\Exceptions;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期或Token无效';
    public $errorCode = 10001;
}