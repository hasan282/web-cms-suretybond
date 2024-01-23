<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('/', 'Login::process', ['filter' => 'csrf']);

$routes->post('/setting/verification/email', 'Setting::verifyProcess');
$routes->post('/setting/verification/send/email', 'Setting::verifySend', ['filter' => 'csrf']);

$routes->post('/setting/change/email', 'Setting::emailChange');
