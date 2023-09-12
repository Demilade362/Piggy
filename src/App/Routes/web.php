<?php

namespace App\Routes;

use App\Controllers\{
    HomeController,
    AboutController
};
use Framework\App;


/**
 * This is the Web.php route file
 * This route file is specifically for the web 
 * You must call the $app instance 
 */

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'index']);
    $app->get('/about', [AboutController::class, 'index']);
}
