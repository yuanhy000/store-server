<?php

namespace App\http\model;

class OrderModel extends BaseModel
{
    protected $table = 'order';
    protected $hidden = ['user_id', 'deleted_at', 'updated_at'];

    public static function getOrderList($uid, $page, $size)
    {
        $result = self::where('user_id', $uid)->orderBy('created_at', 'desc')
            ->paginate($size)
            ->makeHidden(['snap_items', 'snap_address', 'prepay_id'])->toArray();
        return $result;
    }

    public static function getAllOrder($page, $size)
    {
        $result = self::orderBy('created_at', 'desc')
            ->paginate($size)
            ->makeHidden(['snap_items', 'snap_address', 'prepay_id'])->toArray();
        return $result;
    }
}
