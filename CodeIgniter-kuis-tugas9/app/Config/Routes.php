<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'page::hello');
$routes->get('/contact', 'Page::contact');

$routes->setAutoRoute(false);
