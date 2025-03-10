<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Homepage::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/logout', 'Login::logout');
$routes->get('/termin', 'Termin::index');
$routes->get('/input_termin', 'Termin::input');
$routes->get('/data_kontrak', 'Termin::data');
$routes->post('/termin_save', 'Termin::save');
$routes->delete('/termin/delete/(:num)', 'Termin::delete/$1');
$routes->get('/kontrak', 'Kontrak::index');
$routes->get('/kontrak/e-katalog', 'Kontrak::e_katalog');
$routes->get('/kontrak/e-katalog/daftar_kontrak_e_katalog', 'Kontrak::daftar_kontrak_e_katalog');
$routes->get('/kontrak/e-katalog/daftar_kontrak_e_katalog/(:num)', 'Kontrak::detail/$1');
$routes->post('/kontrak/e-katalog_simpan_session', 'Kontrak::pembayaran');
$routes->get('/kontrak/e-katalog/pembayaran', 'Kontrak::e_katalog_termin');
$routes->post('/kontrak/e-katalog/pembayaran/termin_simpan_session', 'Kontrak::e_katalog_termin_submit');
$routes->get('/kontrak/e-katalog/pembayaran/termin', 'Kontrak::e_katalog_item');
$routes->post('/kontrak/e-katalog/pembayaran/termin/item_submit', 'Kontrak::e_katalog_item_submit');
$routes->get('/kontrak/e-katalog/pembayaran/termin/item/review', 'Kontrak::review');
$routes->get('/kontrak/e-katalog/success', 'Kontrak::success');
$routes->get('/kontrak/pl', 'Kontrak::pl');
$routes->get('/kontrak/tender', 'Kontrak::tender');
$routes->get('/export-word', 'WordExport::generate');

