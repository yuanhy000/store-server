<?php

namespace App\http\model;

class ProductImageModel extends BaseModel
{
    protected $table = 'product_image';
    protected $hidden = ['img_id', 'deleted_at', 'product_id'];

    public function imgUrl()
    {
        return $this->belongsTo(ImageModel::class, 'img_id', 'id');
    }
}
