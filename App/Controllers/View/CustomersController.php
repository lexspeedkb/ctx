<?php

namespace App\Controllers\View;

use App\Classes\Customers;
use App\Classes\LoyaltyCards;
use App\Entities\CustomerEntity;
use App\Types\DBWhereParamsType;
use App\UseCases\CustomersUseCase;
use App\UseCases\LoyaltyCardsUseCase;
use Exception;
use JetBrains\PhpStorm\NoReturn;

class CustomersController extends BaseViewController
{
    /**
     * @return void
     */
    public function index(): void
    {
        if (!isset($_POST['s'])) {
            $data['customers_list'] = Customers::findAll();
        } else{
            $data['customers_list'] = Customers::search($_POST['s']);
        }

        $this->render('customers/list', $data);
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $data['loyalty_cards_list'] = LoyaltyCards::findAll(new DBWhereParamsType([
            'where' => 'customer_id IS NULL'
        ]));

        $this->render('customers/create', $data);
    }

    /**
     * @param int $customer_id
     * @return void
     */
    public function edit(int $customer_id): void
    {
        $data['loyalty_cards_list'] = LoyaltyCards::findAll(new DBWhereParamsType([
            'where' => 'customer_id IS NULL'
        ]));
        $data['CustomerEntity'] = Customers::findByPrimary($customer_id);

        if ($data['CustomerEntity'] === null) {
            self::page_404();
        }

        $this->render('customers/edit', $data);
    }

    /**
     * @param int $customer_id
     * @return void
     */
    public function view(int $customer_id): void
    {
        $data['CustomerEntity'] = Customers::findByPrimary($customer_id);

        if ($data['CustomerEntity'] === null) {
            self::page_404();
        }

        $this->render('customers/view', $data);
    }

    /**
     * @return void
     * @throws Exception
     */
    #[NoReturn]
    public function action_create(): void
    {
        $CustomersUseCase    = new CustomersUseCase();
        $LoyaltyCardsUseCase = new LoyaltyCardsUseCase();

        $_POST['registration_date'] = date('Y-m-d');

        $CustomerEntity = (new CustomerEntity())->load($_POST);

        $this->validateEntity($CustomerEntity);

        $NewID = $CustomersUseCase->create($CustomerEntity);

        if ($_POST['loyalty_card_id'] != 'null') {
            $LoyaltyCardsUseCase->setNewOwner($_POST['loyalty_card_id'], $NewID);
        }

        header("Location: /customers");
        die();
    }

    /**
     * @param int $customer_id
     * @return void
     */
    public function action_delete(int $customer_id): void
    {
        $CustomersUseCase = new CustomersUseCase();
        $CustomersUseCase->delete($customer_id);
    }

    /**
     * @param int $customer_id
     * @return void
     * @throws Exception
     */
    #[NoReturn]
    public function action_update(int $customer_id): void
    {
        $CustomerEntity = (new CustomerEntity())->load($_POST);
        $CustomerEntity->id = $customer_id;

        $this->validateEntity($CustomerEntity);

        $CustomersUseCase = new CustomersUseCase();
        $CustomersUseCase->update($CustomerEntity);

        header("Location: /customers");
        die();
    }

    /**
     * @param CustomerEntity $CustomerEntity
     * @return void
     */
    private function validateEntity(CustomerEntity $CustomerEntity): void
    {
        if (strlen($CustomerEntity->name) < 3) {
            self::page_error('Validation error', 'Name must be > 3 chars');
        }

        if (strlen($CustomerEntity->surname) < 3) {
            self::page_error('Validation error', 'Surname must be > 3 chars');
        }

        if (strlen($CustomerEntity->address) < 3) {
            self::page_error('Validation error', 'Address must be > 3 chars');
        }

        if (!filter_var($CustomerEntity->email, FILTER_VALIDATE_EMAIL)) {
            self::page_error('Validation error', 'Invalid E-mail');
        }
    }
}