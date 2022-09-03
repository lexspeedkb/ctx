<?php

namespace App\Controllers\View;

use App\Classes\Orders;

class OrdersController extends BaseViewController
{
    public function index()
    {
        $data['OrdersList'] = Orders::findAllList();

        $this->render('orders/list', $data);
    }

    /**
     * @param $order_id
     * @return void
     */
    public function view($order_id): void
    {
        $data['OrderFullViewEntity'] = Orders::findByPrimaryFullView($order_id);

        $this->render('orders/view', $data);
    }
}