<?php

namespace App\Http\Model;

use App\Http\Model\BaseModel;

class ThirdAppModel extends BaseModel
{
    protected $table = 'third_app';

    public static function check($user_name, $user_pass)
    {
        $result = self::where('app_id', '=', $user_name)
            ->where('app_secret', '=', $user_pass)->first();
        return $result;
    }
}
