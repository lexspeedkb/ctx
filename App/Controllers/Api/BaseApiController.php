<?php

namespace App\Controllers\Api;

use App\Traits\ResponseTrait;

class BaseApiController
{
    use ResponseTrait;

    protected mixed $input;

    public function __construct()
    {
        $rawInput = file_get_contents('php://input');
        $this->input = json_decode($rawInput, true);
    }
}