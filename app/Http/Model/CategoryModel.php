<?php

namespace App\http\model;

class CategoryModel extends BaseModel
{
    protected $table = 'category';
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    public function img()
    {
        return $this->belongsTo(ImageModel::class, 'topic_img_id', 'id');
    }
}
