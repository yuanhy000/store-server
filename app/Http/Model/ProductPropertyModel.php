<?php

namespace App\http\model;

class ProductPropertyModel extends BaseModel
{
    protected $table = 'product_property';
    protected $hidden = ['deleted_at', 'updated_at', 'product_id'];
}
