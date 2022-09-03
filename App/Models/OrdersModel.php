<?php

namespace App\Models;

use App\Classes\Customers;
use App\Classes\Goods;
use App\Classes\LoyaltyCards;
use App\Classes\OrdersToGoods;
use system\BaseModel;

class OrdersModel extends BaseModel
{
    public string $table = 'orders';
    public string $primary = 'id';
    public string $entity = 'App\Entities\OrderEntity';

    /**
     * @param int $order_id
     * @return array
     */
    public function getOrderInfo(int $order_id): array
    {
        $customersModel = Customers::getModel();
        $loyaltyCardsModel = LoyaltyCards::getModel();

        $orderInfo = "SELECT $this->table.*, $customersModel->table.*, $customersModel->table.id as customer_id, $customersModel->table.name as customer_name, $customersModel->table.surname as customer_surname, $loyaltyCardsModel->table.*
                      FROM $this->table
                      LEFT JOIN $customersModel->table
                      ON $customersModel->table.id=$this->table.customer_id
                      LEFT JOIN $loyaltyCardsModel->table
                      ON $loyaltyCardsModel->table.id=$this->table.loyalty_card_id
                      WHERE $this->table.id='$order_id'";

        return $this->db->query($orderInfo)->fetchArray();
    }

    /**
     * @param int $order_id
     * @return array
     */
    public function getGoodsList(int $order_id): array
    {
        $ordersToGoodsModel = OrdersToGoods::getModel();
        $goodsModel = Goods::getModel();
        
        $sqlGetGoods = "SELECT $ordersToGoodsModel->table.*, $goodsModel->table.*
                        FROM $ordersToGoodsModel->table
                        LEFT JOIN $goodsModel->table
                        ON $goodsModel->table.$goodsModel->primary=$ordersToGoodsModel->table.good_id
                        WHERE $ordersToGoodsModel->table.order_id=$order_id";

        return $this->db->query($sqlGetGoods)->fetchAll();
    }
}