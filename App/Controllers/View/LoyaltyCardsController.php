<?php

namespace App\Controllers\View;

use App\Classes\Customers;
use App\Classes\LoyaltyCards;
use App\Entities\CustomerEntity;
use App\Entities\LoyaltyCardEntity;
use App\UseCases\CustomersUseCase;
use App\UseCases\LoyaltyCardsUseCase;
use Exception;
use JetBrains\PhpStorm\NoReturn;

class LoyaltyCardsController extends BaseViewController
{
    /**
     * @return void
     */
    public function index(): void
    {
        $data['loyalty_cards_list'] = LoyaltyCards::findAllWithOwners();

        $this->render('loyalty_cards/list', $data);
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $data['customers_list'] = Customers::findAll();

        $this->render('loyalty_cards/create');
    }

    /**
     * @param int $customer_id
     * @return void
     */
    public function edit(int $customer_id): void
    {
        $data['customers_list'] = Customers::findAll();
        $data['LoyaltyCardEntity'] = LoyaltyCards::findByPrimary($customer_id);

        if ($data['LoyaltyCardEntity'] === null) {
            self::page_404();
        }

        $this->render('loyalty_cards/edit', $data);
    }

    /**
     * @param int $customer_id
     * @return void
     */
    public function view(int $customer_id): void
    {
        $data['LoyaltyCardEntity'] = LoyaltyCards::findByPrimary($customer_id);

        if ($data['LoyaltyCardEntity'] === null) {
            self::page_404();
        }

        $this->render('loyalty_cards/view', $data);
    }

    /**
     * @return void
     */
    #[NoReturn]
    public function action_create(): void
    {
        $LoyaltyCardEntity = (new LoyaltyCardEntity())->load($_POST);

        $this->validateEntity($LoyaltyCardEntity);

        $LoyaltyCardsUseCase = new LoyaltyCardsUseCase();
        $LoyaltyCardsUseCase->create($LoyaltyCardEntity);

        header("Location: /loyaltyCards");
        die();
    }

    /**
     * @param int $id
     * @return void
     */
    public function action_delete(int $id): void
    {
        $LoyaltyCardsUseCase = new LoyaltyCardsUseCase();
        $LoyaltyCardsUseCase->delete($id);
    }

    /**
     * @param int $loyalty_card_id
     * @return void
     */
    #[NoReturn]
    public function action_update(int $loyalty_card_id): void
    {
        $_POST['customer_id'] = $_POST['customer_id'] === 'null' ? null : $_POST['customer_id'];
        $LoyaltyCardEntity = (new LoyaltyCardEntity())->load($_POST);
        $LoyaltyCardEntity->id = $loyalty_card_id;

        $this->validateEntity($LoyaltyCardEntity);

        $LoyaltyCardsUseCase = new LoyaltyCardsUseCase();
        $LoyaltyCardsUseCase->update($LoyaltyCardEntity);

        header("Location: /loyaltyCards");
        die();
    }

    /**
     * @param LoyaltyCardEntity $LoyaltyCardEntity
     * @return void
     */
    private function validateEntity(LoyaltyCardEntity $LoyaltyCardEntity): void
    {
        if (strlen($LoyaltyCardEntity->card_number) != 16) {
            self::page_error('Validation error', 'Card number must be 16 chars!');
        }
    }
}