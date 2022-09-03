<?php

namespace App\Controllers\Api;

use App\UseCases\DashboardUseCase;
use JetBrains\PhpStorm\NoReturn;

class DashboardController extends BaseApiController
{
    /**
     * @return void
     */
    #[NoReturn]
    public function index(): void
    {
        $data = DashboardUseCase::getDashboardInfo();

        $this->respond($data);
    }
}