<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home', 'HomeController::index');
$routes->get('about', 'AboutController::index');
$routes->get('contact', 'ContactController::index');
$routes->get('faq', 'FaqController::index');
