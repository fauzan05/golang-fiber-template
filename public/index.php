<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Fauzannurhidayat\Php\TokoOnline\Controller\AdminController;
use Fauzannurhidayat\Php\TokoOnline\App\Router;
use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Controller\HomeController;
use Fauzannurhidayat\Php\TokoOnline\Controller\UserController;
use Fauzannurhidayat\Php\TokoOnline\Middleware\MustLoginMiddleware;
use Fauzannurhidayat\Php\TokoOnline\Middleware\MustNotLoginMiddleware;

Database::getConnection('prod');

//Home controller
Router::add('GET', '/', HomeController::class, 'index');
//User controller
Router::add('GET', '/users/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
Router::add('GET', '/users/login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/users/logout', UserController::class, 'logout', [MustLoginMiddleware::class]);
Router::add('GET', '/users/updateProfile', UserController::class, 'updateProfile', [MustLoginMiddleware::class]);
Router::add('GET', '/users/dashboard', UserController::class, 'profile', [MustLoginMiddleware::class]);
Router::add('POST', '/users/updateProfile', UserController::class, 'postUpdateProfile', [MustLoginMiddleware::class]);
Router::add('GET', '/users/password', UserController::class, 'updatePassword', [MustLoginMiddleware::class]);
Router::add('POST', '/users/password', UserController::class, 'postUpdatePassword', [MustLoginMiddleware::class]);
Router::add('GET', '/users/listProduct', UserController::class, 'listProduct',[MustNotLoginMiddleware::class]);
Router::add('GET', '/users/productDetail', UserController::class, 'productDetail',[MustLoginMiddleware::class]);
Router::add('POST', '/users/productDetail', UserController::class, 'postProductDetail',[MustLoginMiddleware::class]);
Router::add('GET', '/users/checkoutStatus', UserController::class, 'checkoutStatus',[MustLoginMiddleware::class]);
Router::add('GET', '/users/cart', UserController::class, 'cart',[MustLoginMiddleware::class]);
Router::add('GET', '/users/deleteCart', UserController::class, 'deleteCart',[MustLoginMiddleware::class]);
Router::add('GET', '/users/transaction', UserController::class, 'transaction',[MustLoginMiddleware::class]);
//admin controller
Router::add('GET', '/admin/login', AdminController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/admin/login', AdminController::class, 'postLogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/admin/logout', AdminController::class, 'logout', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/password', AdminController::class, 'updatePassword', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/password', AdminController::class, 'postUpdatePassword', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/editProduct', AdminController::class, 'editProduct', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/addProduct', AdminController::class, 'addProduct', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/addProduct', AdminController::class, 'postAddProduct', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/editProduct', AdminController::class, 'postEditProduct', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/deleteProduct', AdminController::class, 'deleteProduct', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/deleteUser', AdminController::class, 'deleteUser', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/productManagement', AdminController::class, 'productManagement', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/userManagement', AdminController::class, 'userManagement', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/detailProduct', AdminController::class, 'productDetail', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/detailUser', AdminController::class, 'userDetail', [MustLoginMiddleware::class]);


Router::run();
