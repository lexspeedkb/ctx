<?php

namespace App\Entities;

class OrderToGoodEntity extends BaseEntity
{
    public int $order_id = 0;
    public int $good_id = 0;
    public int $count = 0;
    public float $price_on_moment = 0.00;
}