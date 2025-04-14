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

//input E-katalog
$routes->get('/kontrak', 'Kontrak::index');
$routes->get('/kontrak/e-katalog', 'Kontrak::e_katalog');
$routes->post('/kontrak/e-katalog_simpan_session', 'Kontrak::pembayaran');
$routes->get('/kontrak/e-katalog/daftar_kontrak_e_katalog', 'Kontrak::daftar_kontrak_e_katalog');
$routes->get('/kontrak/e-katalog/daftar_kontrak_e_katalog/(:num)', 'Kontrak::detail/$1');
$routes->get('kontrak/e-katalog/generateSP/(:num)', 'Kontrak::generateSP/$1');
$routes->get('kontrak/e-katalog/generateSPMK/(:num)', 'Kontrak::generateSPMK/$1');
$routes->get('kontrak/e-katalog/generateSPP/(:num)', 'Kontrak::generateSPP/$1');
$routes->get('kontrak/e-katalog/generateBAST/(:num)', 'Kontrak::generateBAST/$1');

$routes->get('/kontrak/e-katalog/pembayaran', 'Kontrak::e_katalog_termin');
$routes->post('/kontrak/e-katalog/pembayaran/termin_simpan_session', 'Kontrak::e_katalog_termin_submit');
$routes->get('/kontrak/e-katalog/pembayaran/termin', 'Kontrak::e_katalog_item');
$routes->post('/kontrak/e-katalog/pembayaran/termin/item_submit', 'Kontrak::e_katalog_item_submit');
$routes->get('/kontrak/e-katalog/success', 'Kontrak::success');

//input pl
$routes->get('/kontrak/pl', 'Kontrak::pl');
$routes->post('/kontrak/pl_simpan_session', 'Pl::pembayaran');
$routes->get('/kontrak/pl/pembayaran', 'Pl::pl_termin');
$routes->post('/kontrak/pl/pembayaran/termin_simpan_session', 'Pl::pl_termin_submit');
$routes->get('/kontrak/pl/pembayaran/termin', 'Pl::pl_item');
$routes->post('/kontrak/pl/pembayaran/termin/item_submit', 'Pl::pl_item_submit');
$routes->get('/kontrak/pl/success', 'Kontrak::success');
$routes->get('/kontrak/pl/daftar_kontrak_pl', 'Pl::daftar_kontrak_pl');
$routes->get('/kontrak/pl/daftar_kontrak_pl/(:num)', 'Pl::detail/$1');
$routes->get('kontrak/pl/generateSPK/(:num)', 'Pl::generateSPK/$1');
$routes->get('kontrak/pl/generateSPMK/(:num)', 'Pl::generateSPMK/$1');

//input tender
$routes->get('/kontrak/tender', 'Kontrak::tender');
$routes->post('/kontrak/tender_simpan_session', 'Tender::pembayaran');
$routes->get('/kontrak/tender/pembayaran', 'Tender::tender_termin');
$routes->post('/kontrak/tender/pembayaran/termin_simpan_session', 'Tender::tender_termin_submit');
$routes->get('/kontrak/tender/pembayaran/termin', 'Tender::tender_item');
$routes->post('/kontrak/tender/pembayaran/termin/item_submit', 'Tender::tender_item_submit');
$routes->get('/kontrak/tender/success', 'Kontrak::success');
$routes->get('/kontrak/tender/daftar_kontrak_tender', 'Tender::daftar_kontrak_tender');
$routes->get('/kontrak/tender/daftar_kontrak_tender/(:num)', 'Tender::detail/$1');
$routes->get('kontrak/tender/generatePerjanjian/(:num)', 'Tender::generatePerjanjian/$1');
$routes->get('kontrak/tender/generateSPMK/(:num)', 'Tender::generateSPMK/$1');

//termin
$routes->get('/termin', 'Termin::index');
$routes->get('/input_termin', 'Termin::daftar');
$routes->get('/data_kontrak', 'Termin::data');
$routes->post('/termin/simpan', 'Termin::save');
$routes->delete('/termin/delete/(:num)', 'Termin::delete/$1');