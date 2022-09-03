<?php

namespace App\Traits;

use JetBrains\PhpStorm\NoReturn;

trait ResponseTrait
{
    /**
     * @param array $data
     * @param int $status
     * @return void
     */
    #[NoReturn]
    public function respond(mixed $data = [], int $status = 200): void
    {
        header("HTTP/1.0 " . $status);

        echo json_encode($data, JSON_PRETTY_PRINT);
        die;
    }
}