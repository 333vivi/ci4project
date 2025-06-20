<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('login', 'AuthController::login');
$routes->post('loginSubmit', 'AuthController::loginSubmit');
$routes->get('register', 'AuthController::register');
$routes->post('registerSubmit', 'AuthController::registerSubmit');
$routes->get('logout', 'AuthController::logout');
$routes->post('auth/registerSubmit', 'AuthController::registerSubmit');
$routes->post('auth/loginSubmit', 'AuthController::loginSubmit');
$routes->get('auth/register', 'AuthController::register');
$routes->get('auth/login', 'AuthController::login');


$routes->get('dashboard', 'AdminController::dashboard'); 
$routes->get('admin/dashboard', 'AdminController::dashboard');

$routes->get('admin/addGuitar', 'AdminController::addGuitar');
$routes->get('admin/guitars', 'AdminController::guitars');
$routes->get('admin/add_guitar', 'AdminController::addGuitar'); 
$routes->post('admin/saveGuitar', 'AdminController::saveGuitar'); 
$routes->get('admin/editGuitar/(:num)', 'AdminController::editGuitar/$1');
$routes->post('admin/updateGuitar/(:num)', 'AdminController::updateGuitar/$1');
$routes->post('admin/deleteGuitar/(:num)', 'AdminController::deleteGuitar/$1');

$routes->get('admin/users', 'AdminController::users');
$routes->get('admin/deleteUser/(:num)', 'AdminController::deleteUser/$1');

$routes->get('admin/editUser/(:num)', 'AdminController::editUser/$1');
$routes->post('admin/updateUser/(:num)', 'AdminController::updateUser/$1');

$routes->get('shop', 'Home::shop');

$routes->post('add-to-cart/(:num)', 'Home::addToCart/$1');

$routes->get('cart', 'Home::cart');

$routes->post('cart/update/(:num)', 'Home::updateCart/$1');
$routes->post('cart/remove/(:num)', 'Home::removeFromCart/$1');

$routes->post('checkout', 'Home::checkout');

$routes->get('checkout', 'Home::checkoutPage');

$routes->get('admin/orders', 'AdminController::orders');

$routes->get('admin/order/(:num)', 'AdminController::viewOrder/$1');

$routes->post('admin/updateOrderStatus/(:num)', 'AdminController::updateOrderStatus/$1');

$routes->get('/', function () {
    return redirect()->to('/login');
});
