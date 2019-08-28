<?php

namespace App\Http\Model;

class ThemeModel extends BaseModel
{
    protected $table = 'theme';
    protected $hidden = ['deleted_at', 'topic_img_id', 'head_img_id', 'updated_at'];

    public function topicImg()
    {
        return $this->belongsTo(ImageModel::class, 'topic_img_id', 'id');
    }

    public function headImg()
    {
        return $this->belongsTo(ImageModel::class, 'head_img_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(ProductModel::class, 'theme_product', 'theme_id', 'product_id');
    }

    public static function getThemeByIDs($ids)
    {
        $result = self::with('topicImg', 'headImg')->Find($ids);
        return $result;
    }

    public static function getThemeWithProducts($id)
    {
        $result = self::with(['products', 'topicImg', 'headImg'])->find($id);
        return $result;
    }
}
