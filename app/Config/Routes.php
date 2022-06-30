<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

try {
    if (user()->username != null) {
        $routes->get('/', 'User::index');
    }
} catch (\Throwable $th) {
    $routes->get('/', 'Guest::index');
}

// //user
// if (empty($err)) {
//     $routes->get('/', 'User::index');
// }
$routes->get('/user/index', 'User::index',  ['filter' => 'role:user_uns,user_non_uns,admin']);
$routes->get('/user/labs', 'User::labs', ['filter' => 'role:user_uns,user_non_uns']);
$routes->get('/user/labs/(:segment)', 'User::labDetail/$1', ['filter' => 'role:user_uns,user_non_uns']);
$routes->get('/user/edit/(:segment)', 'User::edit/$1',  ['filter' => 'role:user_uns,user_non_uns,admin']);
$routes->get('/user/pesan', 'User::pesan', ['filter' => 'role:user_uns,user_non_uns']);
$routes->get('/user/data', 'User::getData', ['filter' => 'role:user_uns,user_non_uns']);
$routes->get('/user/datas', 'User::getDatas', ['filter' => 'role:user_uns,user_non_uns']);

//Guest
$routes->get('/', 'Guest::index');
$routes->get('/guest', 'Guest::labs');
$routes->get('/guest/labs', 'Guest::labs');
$routes->get('/guest/labs/(:segment)', 'Guest::labDetail/$1');
$routes->get('/guest/reservation', 'Guest::reservation');

// Admin
$routes->get('/admin', 'Admin::getDashboardData', ['filter' => 'role:admin']);
$routes->get('/admin/dashboard', 'Admin::getDashboardData', ['filter' => 'role:admin']);
$routes->get('/admin/users', 'Admin::users', ['filter' => 'role:admin']);
$routes->get('/admin/data', 'Admin::getData', ['filter' => 'role:admin']);
$routes->delete('/admin/users/delete/(:segment)', 'Admin::delete/$1', ['filter' => 'role:admin']);
$routes->get('/admin/users/edit/(:segment)', 'Admin::edit/$1', ['filter' => 'role:admin']);
$routes->get('/admin/labs', 'Admin::labs', ['filter' => 'role:admin']);
$routes->get('/admin/labs/add', 'Admin::addLab', ['filter' => 'role:admin']);
$routes->delete('/admin/labs/delete/(:segment)', 'Admin::labDelete/$1', ['filter' => 'role:admin']);
$routes->get('/admin/labs/edit/(:segment)', 'Admin::labEdit/$1', ['filter' => 'role:admin']);
$routes->get('/admin/labs/(:segment)', 'Admin::labDetail/$1', ['filter' => 'role:admin']);
$routes->get('/admin/acc/accept/(:segment)', 'Admin::accept/$1', ['filter' => 'role:admin']);
$routes->get('/admin/acc/reject/(:segment)', 'Admin::reject/$1', ['filter' => 'role:admin']);
$routes->get('/admin/users/(:any)', 'Admin::detail/$1', ['filter' => 'role:admin']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
