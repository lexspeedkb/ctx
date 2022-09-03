<?php

namespace App\UseCases;

use App\Classes\Customers;
use App\Classes\LoyaltyCards;
use App\Types\DBWhereParamsType;

class DashboardUseCase
{
    public static function getDashboardInfo(): array
    {
        $CustomersCount = Customers::countAll();
        $UsedCards = LoyaltyCards::countAll(new DBWhereParamsType([
            'where' => 'customer_id IS NOT NULL',
        ]));
        $TopBuyers = CustomersUseCase::getTopBuyersOfLastMonth();

        $data['CustomersCount'] = $CustomersCount;
        $data['UsedCards'] = $UsedCards;
        $data['TopBuyers'] = $TopBuyers;

        return $data;
    }
}