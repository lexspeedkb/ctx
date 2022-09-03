<?php

namespace App\Entities;

class OrderEntity extends BaseEntity
{
    public int $id = 0;
    public int $customer_id = 0;
    public float $total = 0.00;
    public int $loyalty_card_id = 0;
    public string $date = '1970-01-01';
}