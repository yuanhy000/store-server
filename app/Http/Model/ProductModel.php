<?php

namespace App\Http\Model;

class ProductModel extends BaseModel
{
    protected $table = 'product';
    protected $hidden = [
        'deleted_at', 'updated_at', 'pivot', 'from', 'category_id', 'created_at', 'main_img_id'
    ];

    public function getMainImgUrlAttribute($value)
    {
        return $this->prefixImgUrl($value);
    }

    public function images()
    {
        return $this->hasMany(ProductImageModel::class, 'product_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany(ProductPropertyModel::class, 'product_id', 'id');
    }

    public static function getMostRecent($start, $end)
    {
        $total = self::all()->count();
        $end = self::orderBy('created_at', 'desc')->take($end)->get()->makeHidden('summary')->toArray();
        $start = self::orderBy('created_at', 'desc')->take($start)->get()->makeHidden('summary')->toArray();
        $data = array_diff_key($end, $start);
        $result['total'] = $total;
        $result['product'] = $data;
        return $result;
    }

    public static function getProductsByCategoryID($categoryID)
    {
        $result = self::where('category_id', '=', $categoryID)->get();
        return $result;
    }

    public static function getProductDetail($id)
    {
        $result = self::with([
            'images' => function ($query) {
                $query->with(['imgUrl'])->orderBy('order', 'asc');
            } //调整图片order顺序，闭包函数
        ])->with(['properties'])->find($id);
        return $result;
    }

    public static function getProductBySearch($page, $size, $name)
    {
        $result = self::where('name', 'like', "%{$name}%")->orderBy('id','desc')
            ->paginate($size)->makeHidden('summary')->toArray();
        return $result;
    }
}
