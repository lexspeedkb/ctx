<?php

namespace App\Controllers\Api;

use App\Classes\LoyaltyCards;
use App\Entities\CustomerEntity;
use App\Entities\LoyaltyCardEntity;
use App\Types\DBWhereParamsType;
use App\UseCases\CustomersUseCase;
use App\UseCases\LoyaltyCardsUseCase;
use JetBrains\PhpStorm\NoReturn;

class LoyaltyCardsController extends BaseApiController
{
    /**
     * @return void
     */
    #[NoReturn]
    public function listUnused(): void
    {
        $data = LoyaltyCards::findAll(new DBWhereParamsType([
            'where' => 'customer_id IS NULL'
        ]));

        $this->respond($data);
    }

    /**
     * @return void
     */
    #[NoReturn]
    public function list(): void
    {
        $data = LoyaltyCards::findAll();

        $this->respond($data);
    }

    /**
     * @param int $id
     * @return void
     */
    #[NoReturn]
    public function getByPrimary(int $id): void
    {
        $data = LoyaltyCards::findByPrimary($id);

        $this->respond($data);
    }

    /**
     * @return void
     */
    #[NoReturn]
    public function delete(int $id): void
    {
        $LoyaltyCardsUseCase = new LoyaltyCardsUseCase();
        $result = $LoyaltyCardsUseCase->delete($id);

        if ($result) {
            $this->respond();
        } else {
            $this->respond('Cannot delete card, that have orders', 403);
        }
    }

    /**
     * @param $loyalty_card_id
     * @return void
     */
    #[NoReturn]
    public function update($loyalty_card_id): void
    {
        $this->input['loyalty_card']['customer_id'] = $this->input['customer_id'] === 'null' ? null : $this->input['customer_id'];
        $LoyaltyCardEntity = (new LoyaltyCardEntity())->load($this->input['loyalty_card']);
        $LoyaltyCardEntity->id = $loyalty_card_id;

        $this->validateEntity($LoyaltyCardEntity);

        $LoyaltyCardsUseCase = new LoyaltyCardsUseCase();
        $LoyaltyCardsUseCase->update($LoyaltyCardEntity);

        $this->respond();
    }

    /**
     * @param LoyaltyCardEntity $LoyaltyCardEntity
     * @return void
     */
    private function validateEntity(LoyaltyCardEntity $LoyaltyCardEntity): void
    {
        if (strlen($LoyaltyCardEntity->card_number) != 16) {
            $this->respond( 'Card number must be 16 chars!', 400);
        }
    }
}