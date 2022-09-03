<?php

namespace App\Controllers\View;

use JetBrains\PhpStorm\NoReturn;

class BaseViewController
{
    protected function render(string $page, array $data = []): void
    {
        require_once ROOT . 'App/Views/common/head.php';
        require_once ROOT . 'App/Views/pages/' . $page . '.php';
        require_once ROOT . 'App/Views/common/foot.php';
    }

    #[NoReturn]
    public static function page_404(): void
    {
        header("HTTP/1.0 404 Not Found");

        require_once ROOT . 'App/Views/common/head.php';
        require_once ROOT . 'App/Views/pages/404.php';
        require_once ROOT . 'App/Views/common/foot.php';
        die;
    }

    #[NoReturn]
    public static function page_error(string $header, string $subheader): void
    {
        header("HTTP/1.0 404 Not Found");

        require_once ROOT . 'App/Views/common/head.php';
        require_once ROOT . 'App/Views/pages/error.php';
        require_once ROOT . 'App/Views/common/foot.php';
        die;
    }
}