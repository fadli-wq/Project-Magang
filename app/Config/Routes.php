<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Homepage::index');
$routes->get('/login', 'Login::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/termin', 'Termin::index');
$routes->get('/input_termin', 'Termin::input');
$routes->get('/data_kontrak', 'Termin::data');
$routes->post('/termin_save', 'Termin::save');
$routes->delete('/termin/delete/(:num)', 'Termin::delete/$1');
$routes->get('/kontrak', 'Kontrak::index');
$routes->get('/kontrak/e-katalog', 'Kontrak::e_katalog');
$routes->get('/kontrak/pl', 'Kontrak::pl');
$routes->get('/kontrak/tender', 'Kontrak::tender');
$routes->get('/export-word', 'WordExport::generate');

