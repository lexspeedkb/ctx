<?php

namespace App\Entities;

class LoyaltyCardEntity extends BaseEntity
{
    public int $id = 0;
    public string $card_number = '';
    public bool $is_virtual = false;
    public int|null $customer_id = null;
}