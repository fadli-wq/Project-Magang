<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/termin', 'Termin::index');
$routes->post('/termin_save', 'Termin::save');
$routes->delete('/termin/delete/(:num)', 'Termin::delete/$1');
