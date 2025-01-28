<?php
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-API-KEY, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Headers, Authorization, observe, enctype, Content-Length, X-Csrf-Token");
    header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, PATCH, OPTIONS");
    header("Access-Control-Allow-Credentials: true");
    header('content-type: application/json; charset=utf-8');

    header("HTTP/1.1 200 OK CORS");
    exit;
}

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
header('Access-Control-Allow-Origin: *');


$routes->group('notices', function ($routes) {
    $routes->post('insert', 'NoticesController::insert');
    $routes->get('active', 'NoticesController::fetchActive');
});
