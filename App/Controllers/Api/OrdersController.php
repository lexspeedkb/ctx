<?php

namespace App\Controllers\Api;

use App\Classes\Orders;
use JetBrains\PhpStorm\NoReturn;

class OrdersController extends BaseApiController
{
    /**
     * @return void
     */
    #[NoReturn]
    public function list(): void
    {
        $data = Orders::findAllList();

        $this->respond($data);
    }

    /**
     * @param $order_id
     * @return void
     */
    #[NoReturn]
    public function view($order_id): void
    {
        $data = Orders::findByPrimaryFullView($order_id);

        $this->respond($data);
    }
}