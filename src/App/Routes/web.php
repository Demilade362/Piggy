<?php

namespace App\Routes;

use App\Controllers\{
    HomeController,
    AboutController,
    AuthController
};
use App\Middlewares\AuthRequiredMiddleware;
use App\Middlewares\GuestOnlyMiddleware;
use Framework\App;


/**
 * This is the Web.php route file
 * This route file is specifically for the web 
 * You must call the $app instance 
 */

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'index'])->middleware(AuthRequiredMiddleware::class);
    $app->get('/about', [AboutController::class, 'index']);
    $app->get("/register", [AuthController::class, 'registerView'])->middleware(GuestOnlyMiddleware::class);
    $app->post("/register", [AuthController::class, 'register'])->middleware(GuestOnlyMiddleware::class);
    $app->get('/login', [AuthController::class, 'loginView'])->middleware(GuestOnlyMiddleware::class);
    $app->post("/login", [AuthController::class, 'login'])->middleware(GuestOnlyMiddleware::class);
    $app->get("/logout", [AuthController::class, 'logout'])->middleware(AuthRequiredMiddleware::class);
}
