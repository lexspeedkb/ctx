<?php

namespace App\Entities\Mixed;

use App\Entities\OrderEntity;

class OrdersListEntity extends OrderEntity
{
    public string $customer_name = '';
    public string $customer_surname = '';
    public string $card_number = '';
}