<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// $route['login'] = 'login';
$routes->get('login','Pages::login');
// $routes->view('login', 'login');
