<?php

namespace App\Classes;

use App\Entities\Mixed\OrderFullViewEntity;
use App\Entities\Mixed\OrdersListEntity;
use App\Entities\Mixed\OrderToFullGoodEntity;
use App\Entities\OrderEntity;
use App\Interfaces\ClassInterface;
use App\Types\DBWhereParamsType;

class Orders extends OrderEntity implements ClassInterface
{
    use BaseClass;

    /**
     * @return OrdersListEntity[]|null
     */
    public static function findAllList(): array|null
    {
        $customersModel = Customers::getModel();
        $loyaltyCardsModel = LoyaltyCards::getModel();
        $ordersModel = self::getModel();

        return self::findAll(new DBWhereParamsType([
            'select' => "$ordersModel->table.*, $customersModel->table.name AS customer_name, $customersModel->table.surname AS customer_surname,$loyaltyCardsModel->table.card_number",
            'join' => " LEFT JOIN $customersModel->table ON $ordersModel->table.customer_id=$customersModel->table.id
                        LEFT JOIN $loyaltyCardsModel->table ON $ordersModel->table.loyalty_card_id=$loyaltyCardsModel->table.id",
            'custom_entity' => 'App\Entities\Mixed\OrdersListEntity',
        ]));
    }

    /**
     * @param int $order_id
     * @return OrderFullViewEntity|null
     */
    public static function findByPrimaryFullView(int $order_id): OrderFullViewEntity|null
    {
        $ordersModel = self::getModel();

        $OrderEntity = $ordersModel->getOrderInfo($order_id);
        $GoodsList = $ordersModel->getGoodsList($order_id);

        $OrderEntity['goods_list'] = [];
        foreach ($GoodsList as $goodItem) {
            $OrderEntity['goods_list'][] = (new OrderToFullGoodEntity())->load($goodItem);
        }

        return (new OrderFullViewEntity())->load($OrderEntity);
    }
}