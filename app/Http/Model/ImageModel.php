<?php

namespace App\Http\Model;

class ImageModel extends BaseModel
{
    protected $table = 'image';
    protected $hidden = ['id', 'from', 'deleted_at', 'updated_at'];

    public function getUrlAttribute($value)
    {
        return $this->prefixImgUrl($value);
    }
}
