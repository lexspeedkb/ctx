<?php

namespace App\Controllers\View;

use App\UseCases\DashboardUseCase;

class DashboardController extends BaseViewController
{
    public function index()
    {
        $data = DashboardUseCase::getDashboardInfo();

        $this->render('dashboard/index', $data);
    }
}