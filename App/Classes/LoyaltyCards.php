<?php

namespace App\Classes;

use App\Entities\LoyaltyCardEntity;
use App\Entities\Mixed\LoyaltyCardWithOwnerEntity;
use App\Interfaces\ClassInterface;
use App\Types\DBWhereParamsType;

class LoyaltyCards extends LoyaltyCardEntity implements ClassInterface
{
    use BaseClass;

    /**
     * @return LoyaltyCardWithOwnerEntity[]|null
     */
    public static function findAllWithOwners(): array|null
    {
        $customersModel = Customers::getModel();
        $loyaltyCardsModel = self::getModel();

        return self::findAll(new DBWhereParamsType([
            'select' => "$loyaltyCardsModel->table.*, $customersModel->table.name AS customer_name, $customersModel->table.surname AS customer_surname",
            'join' => " LEFT JOIN $customersModel->table ON $loyaltyCardsModel->table.customer_id=$customersModel->table.id",
            'custom_entity' => 'App\Entities\Mixed\LoyaltyCardWithOwnerEntity',
        ]));
    }
}