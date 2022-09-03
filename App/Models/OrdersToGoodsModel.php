<?php

namespace App\Models;

use system\BaseModel;

class OrdersToGoodsModel extends BaseModel
{
    public string $table = 'orders_to_goods';
    public string $entity = 'App\Entities\OrderToGoodEntity';
}