<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Page::hello');
$routes->get('/contact', 'Page::contact');

$routes->setAutoRoute(false);
