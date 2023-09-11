<?php

use App\Controllers\HomeController;



/**
 * This is the Web.php route file
 * This route file is specifically for the web 
 * You must call the $app instance 
 */

$app->get('/', [HomeController::class, 'index']);
$app->get('/about', [HomeController::class, 'show']);
