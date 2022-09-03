<?php

namespace App\UseCases;

use App\Classes\Customers;
use App\Classes\Orders;
use App\Entities\CustomerEntity;
use Exception;

class CustomersUseCase
{
    /**
     * @throws Exception
     */
    public function create(CustomerEntity $CustomerEntity): int|bool
    {
        try {
            $result = Customers::create($CustomerEntity);
        } catch (Exception $exception) {
            die($exception);
        }

        return $result;
    }

    /**
     * @param int $customer_id
     * @return int|bool
     */
    public function delete(int $customer_id): int|bool
    {
        return Customers::deleteByPrimary($customer_id);
    }

    /**
     * @throws Exception
     */
    public function update(CustomerEntity $CustomerEntity): int|bool
    {
        try {
            $result = Customers::update($CustomerEntity);
        } catch (Exception $exception) {
            die($exception);
        }

        return $result;
    }


    /**
     * @return array
     */
    public static function getTopBuyersOfLastMonth(): array
    {
        $ordersModel = Orders::getModel();
        $customersModel = Customers::getModel();

        $startDate = date('Y-m-d', strtotime(date('Y-m-d') . '-30 days'));

        $sql = "SELECT *, SUM(total) AS total_for_30_days
                FROM $ordersModel->table
                LEFT JOIN $customersModel->table
                ON $customersModel->table.id=$ordersModel->table.customer_id
                WHERE date >= $startDate
                GROUP BY customer_id
                ORDER BY total_for_30_days DESC
                LIMIT 0, 10";

        return $ordersModel->db->query($sql)->fetchAll();
    }
}