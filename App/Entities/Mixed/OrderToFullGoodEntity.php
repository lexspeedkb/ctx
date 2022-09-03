<?php

namespace App\Entities\Mixed;

use App\Entities\GoodEntity;

class OrderToFullGoodEntity extends GoodEntity
{
    public float $price_on_moment = 0.0;
    public int $count = 0;
}