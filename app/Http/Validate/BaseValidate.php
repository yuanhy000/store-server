<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16
 * Time: 23:07
 */

namespace App\Http\Validate;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class BaseValidate extends Validator
{
    public function goCheck($input)
    {
        $Input = [];
        array_push($Input, $input);
        var_dump($Input);
        var_dump($this->rule);
        $validator = Validator::make($Input, $this->rule, $this->message);
        if ($validator->passes()) {
            echo('OK');
            return true;
        } else {
            var_dump($validator->errors());
        }
    }
    /*public function goCheck($input)
    {
        $request = Request::all();

        $result = $this->check($request);
        if (!$result) {
            $error = $this->error;
            throw new Exception($error);
        } else {
            return true;
        }
    }*/
}