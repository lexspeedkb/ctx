<?php

namespace App\Entities\Mixed;

use App\Entities\LoyaltyCardEntity;

class LoyaltyCardWithOwnerEntity extends LoyaltyCardEntity
{
    public string $customer_name = '';
    public string $customer_surname = '';
}