<?php

use App\Controllers\View\BaseViewController;
use system\Firewall;

const REQUEST_TYPE_VIEW = 0;
const REQUEST_TYPE_API  = 1;

$request = $_SERVER['REQUEST_URI'];

$request_type = REQUEST_TYPE_VIEW;
$request_method = $_SERVER['REQUEST_METHOD'];

if ($request_method === 'OPTIONS') {
    return true;
}

//Connect routes file by request type
if (str_starts_with($request, '/api')) {
    Firewall::connection();
    $request_type = REQUEST_TYPE_API;
    $routes = @include_once ROOT . '/App/Config/ApiRoutes.php';
} else {
    $routes = @include_once ROOT . '/App/Config/ViewRoutes.php';
}

if ($routes === false) {
    die('Routes config file not found');
}

$request = str_replace('/api', '', $request);

if ($request === '') {
    $request = '/';
}

$requestPieces = explode('/', $request);

if (sizeof($requestPieces) > 3) {
    $tmpRequestPieces = $requestPieces;
    unset($tmpRequestPieces[0], $tmpRequestPieces[1], $tmpRequestPieces[2]);
    $params = [...$tmpRequestPieces];
} else {
    $params = [];
}

if (sizeof($requestPieces) >= 3) {
    $request = '/' . $requestPieces[1] . '/' . $requestPieces[2];
} else {
    $request = '/' . $requestPieces[1];
}


if (!isset($routes["($request_method)" . $request], $routes)) {
    BaseViewController::page_404();
    die;
}

$alias = $routes["($request_method)" . $request];

$pieces = explode('/', $alias);

$MethodName = $pieces[1] ?? 'index';

$ControllerName = $pieces[0] . 'Controller';

$ControllerInstanceName = match ($request_type) {
    REQUEST_TYPE_VIEW => "App\Controllers\View\\$ControllerName",
    REQUEST_TYPE_API  => "App\Controllers\Api\\$ControllerName",
};

$ControllerInstance = new $ControllerInstanceName();
$ControllerInstance->$MethodName(...$params);


