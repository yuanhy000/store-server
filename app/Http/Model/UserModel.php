<?php

namespace App\http\model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $fillable = ['openid'];

    public static function getByOpenID($openid)
    {
        $user = self::where('openid', '=', $openid)->get();
        return $user;
    }

    public function address()
    {
        return $this->hasOne(UserAddressModel::class, 'user_id', 'id');
    }
}
