<?php

namespace App\Routes;

use App\Controllers\{
    HomeController,
    AboutController,
    AuthController,
    ErrorController,
    ReceiptController,
    TransactionController
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
    $app->get("/transaction", [TransactionController::class, 'index'])->middleware(AuthRequiredMiddleware::class);
    $app->post("/transaction", [TransactionController::class, 'create'])->middleware(AuthRequiredMiddleware::class);
    $app->get("/transaction/{transaction}", [TransactionController::class, 'editView'])->middleware(AuthRequiredMiddleware::class);
    $app->post("/transaction/{transaction}", [TransactionController::class, 'edit'])->middleware(AuthRequiredMiddleware::class);
    $app->delete("/transaction/{transaction}", [TransactionController::class, 'delete'])->middleware(AuthRequiredMiddleware::class);
    $app->get("/transaction/{transaction}/receipt", [ReceiptController::class, 'uploadView'])->middleware(AuthRequiredMiddleware::class);
    $app->post("/transaction/{transaction}/receipt", [ReceiptController::class, 'upload'])->middleware(AuthRequiredMiddleware::class);
    $app->get('/transaction/{transaction}/receipt/{receipt}', [ReceiptController::class, 'download'])->middleware(AuthRequiredMiddleware::class);
    $app->get("/transaction/{transaction}/receipt/{receipt}", [ReceiptController::class, 'deleteReceipt'])->middleware(AuthRequiredMiddleware::class);

    $app->setErrorHandler([ErrorController::class, 'notFound']);
}
