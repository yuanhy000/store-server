<?php

namespace App\http\model;

class OrderProductModel extends BaseModel
{
    protected $table = 'order_product';
    protected $fillable = ['order_id', 'product_id', 'count'];


}

