<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/18
 * Time: 21:12
 */

namespace App\Exceptions;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}