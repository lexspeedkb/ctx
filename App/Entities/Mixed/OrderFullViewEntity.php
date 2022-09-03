<?php

namespace App\Entities\Mixed;

use App\Entities\GoodEntity;
use App\Entities\OrderEntity;

class OrderFullViewEntity extends OrderEntity
{
    public string $customer_name = '';
    public string $customer_surname = '';
    public string $card_number = '';
    /**
     * @var OrderToFullGoodEntity[]
     */
    public array $goods_list = [];
}