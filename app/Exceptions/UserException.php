<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/21
 * Time: 22:50
 */

namespace App\Exceptions;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = 'No 用户不存在';
    public $errorCode = 60000;
}