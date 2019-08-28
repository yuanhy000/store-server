<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/17
 * Time: 23:52
 */

namespace App\Exceptions;

class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求的banner不存在';
    public $errorCode = 40000;
}