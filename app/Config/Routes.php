<?php

namespace Config;

// Create a new instance of our RouteCollection class.
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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('stocks', 'Stocks::index');
$routes->get('indexs', 'Indexs::index');

$routes->match(['get', 'post'], 'stocks/add', 'Stocks::add');
$routes->match(['get', 'post'], 'stocks/exchange', 'Stocks::exchange');
$routes->match(['get', 'post'], 'indexs/add', 'Indexs::add');

$routes->match(['get', 'post'], 'idx-crawl', 'Indexs::crawl');
$routes->match(['get', 'post'], 'crawl', 'Stocks::crawl');

$routes->match(['get', 'post'], 'signup', 'User::signup');
$routes->match(['get', 'post'], 'login', 'User::login');
$routes->match(['get', 'post'], 'u/(:segment)', 'User::view/$1');
$routes->match(['get', 'post'], 'search', 'Search::index');
$routes->match(['get', 'post'], '404', 'Home::eror404');

// $routes->get('stocks/exchange', 'Stocks::exchange');
// $routes->get('stocks/add', 'Stocks::add');
$routes->get('stocks/(:segment)', 'Stocks::view/$1');
$routes->get('indexs/(:segment)', 'Indexs::view/$1');

$routes->get('logout', 'User::logout');

$routes->get('test', 'User::test');

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
