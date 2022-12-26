<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Fauzannurhidayat\PhpMvc\Login\App\Router;
use Fauzannurhidayat\PhpMvc\Login\Config\Database;
use Fauzannurhidayat\PhpMvc\Login\Controller\HomeController;
use Fauzannurhidayat\PhpMvc\Login\Controller\UserController;

Database::getConnection('prod');

//Home controller
Router::add('GET', '/', HomeController::class, 'index');
//User controller
Router::add('GET', '/users/register', UserController::class, 'register');
Router::add('POST', '/users/register', UserController::class, 'postRegister');

Router::run();