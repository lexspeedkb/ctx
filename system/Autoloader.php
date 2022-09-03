<?php
spl_autoload_register (function ($class) {
    $file = ROOT . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});