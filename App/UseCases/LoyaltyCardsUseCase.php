<?php

namespace App\UseCases;

use App\Classes\Customers;
use App\Classes\LoyaltyCards;
use App\Entities\CustomerEntity;
use App\Entities\LoyaltyCardEntity;
use Exception;

class LoyaltyCardsUseCase
{
    /**
     * @param LoyaltyCardEntity $LoyaltyCardEntity
     * @return int|bool
     */
    public function create(LoyaltyCardEntity $LoyaltyCardEntity): int|bool
    {
        try {
            $result = LoyaltyCards::create($LoyaltyCardEntity);
        } catch (Exception $exception) {
            die($exception);
        }

        return $result;
    }

    /**
     * @param int $loyalty_card_id
     * @return int|bool
     */
    public function delete(int $loyalty_card_id): int|bool
    {
        return LoyaltyCards::deleteByPrimary($loyalty_card_id);
    }

    /**
     * @param LoyaltyCardEntity $LoyaltyCardEntity
     * @return int|bool
     */
    public function update(LoyaltyCardEntity $LoyaltyCardEntity): int|bool
    {
        try {
            $result = LoyaltyCards::update($LoyaltyCardEntity);
        } catch (Exception $exception) {
            die($exception);
        }

        return $result;
    }

    /**
     * @param $loyalty_card_id
     * @param int|null $new_customer_id
     * @return bool
     */
    public function setNewOwner($loyalty_card_id, int|null $new_customer_id): bool
    {
        return LoyaltyCards::updateByPrimary($loyalty_card_id, ['customer_id' => $new_customer_id]);
    }
}