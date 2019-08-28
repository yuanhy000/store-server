<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/17
 * Time: 23:52
 */

namespace App\Exceptions;

class SuccessMessage extends BaseException
{
    public $code = 201;
    public $msg = 'success!';
    public $errorCode = 0;
}