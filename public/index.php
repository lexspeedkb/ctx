<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

// Important! Slash on the end
const ROOT = 'D:\OpenServer\domains\cortex-test\\';

$env = require_once ROOT . 'env.php';

require_once ROOT . '/system/Autoloader.php';
require_once ROOT . '/system/Router.php';
