<?php

namespace App\http\model;

use Illuminate\Database\Eloquent\Model;

class UserAddressModel extends Model
{
    protected $table = 'user_address';
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at', 'user_id'];
    protected $fillable = ['name', 'mobile', 'province', 'city', 'county', 'detail'];
}
