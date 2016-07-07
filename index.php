<?php
include('bootstrap.php');

/**
 * Routes style
 *
 * 1. /user/login
 * 2. /account/:accountName
 */
$routes = array(
    '/' => 'index/index',
);

$app = new Jimu($routes);
$app->run();
