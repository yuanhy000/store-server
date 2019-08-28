<?php

namespace App\Http\Model;

class BannerModel extends BaseModel
{
    protected $table = 'banner';
    protected $hidden = ['updated_at', 'deleted_at'];

    public function items()
    {
        return $this->hasMany(BannerItemModel::class, 'banner_id', 'id');
    }

    public static function getBannerByID($id)
    {
        $banner = self::with(['items', 'items.img'])->where('id', $id)->get();
        return $banner;
    }
}
