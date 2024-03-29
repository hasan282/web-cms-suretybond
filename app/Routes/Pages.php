<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/user', 'User::index');
$routes->get('/user/switch', 'Login::switch');

$routes->get('/certificate', 'Certificate::index');
$routes->get('/add/certificate', 'Certificate::add');

$routes->get('/principal', 'Principal::index');
$routes->get('/add/principal', 'Principal::add');

$routes->get('/insurance', 'Insurance::index');
$routes->get('/add/insurance', 'Insurance::add');

$routes->get('/subagent', 'Subagent::index');
$routes->get('/add/subagent', 'Subagent::add');

$routes->get('/blanko', 'Blanko::index');

$routes->get('/manage/user', 'User::manage');

$routes->get('/report', 'Report::index');

$routes->get('/setting', 'Setting::index');
$routes->get('/setting/change/name', 'Setting::name');
$routes->get('/setting/change/email', 'Setting::email');
$routes->get('/setting/change/username', 'Setting::username');
$routes->get('/setting/change/password', 'Setting::password');
$routes->get('/setting/verification/email', 'Setting::verify');

$routes->get('/account/verification', 'Security::index');

$routes->get('/logout', 'Login::out');
