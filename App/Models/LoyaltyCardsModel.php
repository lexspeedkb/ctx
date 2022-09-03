<?php

namespace App\Models;

use system\BaseModel;

class LoyaltyCardsModel extends BaseModel
{
    public string $table = 'loyalty_cards';
    public string $primary = 'id';
    public string $entity = 'App\Entities\LoyaltyCardEntity';
}