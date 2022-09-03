<?php

namespace App\Controllers\Api;

use App\Classes\Customers;
use App\Entities\CustomerEntity;
use App\UseCases\CustomersUseCase;
use App\UseCases\LoyaltyCardsUseCase;
use Exception;
use JetBrains\PhpStorm\NoReturn;

class CustomersController extends BaseApiController
{
    /**
     * @return void
     *
     * Return list of customers, if post "search" try to search by name, surname or card number
     */
    #[NoReturn]
    public function list(): void
    {
        if (!isset($this->input['search'])) {
            $data = Customers::findAll();
        } else{
            $data = Customers::search($this->input['search']);
        }

        $this->respond($data);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function create(): void
    {
        $CustomersUseCase    = new CustomersUseCase();
        $LoyaltyCardsUseCase = new LoyaltyCardsUseCase();

        $this->input['customer']['registration_date'] = date('Y-m-d');

        $CustomerEntity = (new CustomerEntity())->load($this->input['customer']);

        $this->validateEntity($CustomerEntity);

        $NewID = $CustomersUseCase->create($CustomerEntity);

        if ($this->input['loyalty_card_id'] != 'null') {
            $LoyaltyCardsUseCase->setNewOwner($this->input['loyalty_card_id'], $NewID);
        }

        $this->respond($NewID);
    }

    /**
     * @param int $customer_id
     * @return void
     */
    #[NoReturn]
    public function getByPrimary(int $customer_id): void
    {
        $data = Customers::findByPrimary($customer_id);

        if ($data === null) {
            $this->respond(null, 404);
        }

        $this->respond($data);
    }

    /**
     * @param int $customer_id
     * @return void
     */
    #[NoReturn]
    public function delete(int $customer_id): void
    {
        $CustomersUseCase = new CustomersUseCase();
        $result = $CustomersUseCase->delete($customer_id);

        if ($result) {
            $this->respond();
        } else {
            $this->respond('Cannot delete user, that have orders and loyalty card', 403);
        }
    }

    /**
     * @param int $customer_id
     * @return void
     */
    #[NoReturn]
    public function update($customer_id): void
    {
        $CustomerEntity = (new CustomerEntity())->load($this->input['customer']);
        $CustomerEntity->id = $customer_id;

        $this->validateEntity($CustomerEntity);

        $CustomersUseCase = new CustomersUseCase();
        $CustomersUseCase->update($CustomerEntity);

        $this->respond();
    }

    /**
     * @param CustomerEntity $CustomerEntity
     * @return void
     */
    private function validateEntity(CustomerEntity $CustomerEntity): void
    {
        if (strlen($CustomerEntity->name) < 3) {
            $this->respond('Name must be > 3 chars', 400);
        }

        if (strlen($CustomerEntity->surname) < 3) {
            $this->respond('Surname must be > 3 chars', 400);
        }

        if (strlen($CustomerEntity->address) < 3) {
            $this->respond('Address must be > 3 chars', 400);
        }

        if (!filter_var($CustomerEntity->email, FILTER_VALIDATE_EMAIL)) {
            $this->respond('Invalid E-mail', 400);
        }
    }
}