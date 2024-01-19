<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('/', 'Login::process');
$routes->post('/forgot', 'ForgotPassword::sendEmail');
$routes->post('/forgot', 'ForgotPassword::resetPassword');
