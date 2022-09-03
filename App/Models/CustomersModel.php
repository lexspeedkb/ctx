<?php

namespace App\Models;

use App\Classes\LoyaltyCards;
use system\BaseModel;

class CustomersModel extends BaseModel
{
    public string $table = 'customers';
    public string $primary = 'id';
    public string $entity = 'App\Entities\CustomerEntity';

    /**
     * @param $s
     * @return array
     */
    public function search($s): array
    {
        $loyaltyCardsModel = LoyaltyCards::getModel();

        $sql = "(SELECT $this->table.*
                FROM $this->table
                WHERE name LIKE '%$s%' OR surname LIKE '%$s%') 
                UNION
                (SELECT $this->table.*
                    FROM $this->table
                    WHERE $this->table.$this->primary IN (
                        SELECT `customer_id`
                        FROM $loyaltyCardsModel->table
                        WHERE card_number LIKE '%$s%'
                    )
                )";

        $data = $this->db->query($sql)->fetchAll();

        return $data;
    }
}