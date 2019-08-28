<?php

namespace App\Http\Model;

class BannerItemModel extends BaseModel
{
    protected $table = 'banner_item';

    protected $hidden = ['id', 'img_id', 'deleted_at', 'updated_at', 'banner_id'];

    public function img()
    {
        return $this->belongsTo(ImageModel::class, 'img_id', 'id');
    }
}
