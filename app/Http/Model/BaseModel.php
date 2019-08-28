<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function prefixImgUrl($value)
    {
        if ($this->from == 1) {
            return config('setting.img_prefix') . $value;
        } else {
            return $value;
        }
    }
}
