<?php

namespace App\Routes;

use App\Controllers\{
    HomeController,
    AboutController,
    AuthController
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
    $app->get("/register", [AuthController::class, 'registerPage']);
    $app->post("/register", [AuthController::class, 'register']);
}
