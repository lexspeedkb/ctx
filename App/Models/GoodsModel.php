<?php

namespace App\Models;

use system\BaseModel;

class GoodsModel extends BaseModel
{
    public string $table = 'goods';
    public string $primary = 'id';
    public string $entity = 'App\Entities\GoodEntity';
}