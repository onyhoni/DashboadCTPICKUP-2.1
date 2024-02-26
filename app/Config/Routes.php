<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Controllers\CategoryController;
use App\Controllers\CreateController;

$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.?


$routes->get('/', 'HomeController::index');
$routes->get('/datadashboard', 'HomeController::datadashboard');

$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::store');

$routes->get('/register', 'RegisterController::index');
$routes->post('/register', 'RegisterController::store');


$routes->get('/logout', 'LogoutController::index');

$routes->get('/tiket', 'TiketController::index');
$routes->post('/tiket', 'TiketController::store');
$routes->post('/tiket/take', 'TiketController::take');
$routes->post('/tiket/close', 'TiketController::close');
$routes->post('/tiket/open', 'TiketController::open');
$routes->post('/tiket/delete', 'TiketController::delete');
$routes->get('/tiket/show', 'TiketController::show');
$routes->get('/tiket/(:any)', 'TiketController::detail/$1');

$routes->get('/MyTiket', 'MyTiketController::index');
$routes->get('/MyTiket/show', 'MyTiketController::show');
$routes->post('/MyTiket', 'MyTiketController::store');


$routes->get('/report', 'ReportController::index');
$routes->get('/report/show', 'ReportController::show');

$routes->get('/account', 'AccountController::index');
$routes->get('/account/create', 'AccountController::create');
$routes->post('/account', 'AccountController::store');

$routes->get('/account/show', 'AccountController::show');

$routes->get('/account/(:num)/edit', 'AccountController::edit/$1');
$routes->put('/account/(:num)', 'AccountController::update/$1');
$routes->delete('/account/(:num)', 'AccountController::destroy/$1');


$routes->get('/edit', 'EditController::index');
$routes->post('/dataedit', 'EditController::dataedit');
$routes->post('/update', 'EditController::update');

$routes->post('/pesan', 'PesanController::store');

$routes->get('log/getSubType', 'LogBookController::getSubType');
$routes->get('log/getDesc', 'LogBookController::getDesc');
$routes->get('log/getImpact', 'LogBookController::getImpact');
$routes->post('log/updatelog', 'LogBookController::updatelog');
$routes->post('log/close', 'LogBookController::close');
$routes->resource('/log', ['controller' => 'LogBookController']);

$routes->get('create', 'CreateController::create', ['filter' => 'adminGuard']);
$routes->post('create/category', 'CreateController::category', ['filter' => 'adminGuard']);
$routes->post('create/issue', 'CreateController::issue', ['filter' => 'adminGuard']);
$routes->post('create/subType', 'CreateController::subType', ['filter' => 'adminGuard']);
$routes->post('create/description', 'CreateController::description', ['filter' => 'adminGuard']);
$routes->post('create/impact', 'CreateController::impact', ['filter' => 'adminGuard']);

$routes->get('showlog', 'ShowlogbookController::index', ['filter' => 'adminGuard']);
$routes->post('showlog/editCategory', 'ShowlogbookController::editCategory', ['filter' => 'adminGuard']);
$routes->put('showlog/updateCategory', 'ShowlogbookController::updateCategory', ['filter' => 'adminGuard']);

$routes->post('showlog/editSubType', 'ShowlogbookController::editSubType', ['filter' => 'adminGuard']);
$routes->put('showlog/updateSubType', 'ShowlogbookController::updateSubType', ['filter' => 'adminGuard']);

$routes->post('showlog/editDescription', 'ShowlogbookController::editDescription', ['filter' => 'adminGuard']);
$routes->put('showlog/updateDescription', 'ShowlogbookController::updateDescription', ['filter' => 'adminGuard']);

$routes->resource('/user', ['controller' => 'UserController', 'filter' => 'adminGuard']);
$routes->resource('/zip', ['controller' => 'ZipController']);

$routes->get('/isread/store', 'IsreadController::store');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
