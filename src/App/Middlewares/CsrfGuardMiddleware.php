<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Contracts\MiddlewareInterface;

class CsrfGuardMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $validMethod = ['POST', 'PUT', 'PATCH', 'DELETE'];

        if (!in_array($requestMethod, $validMethod)) {
            $next();
            return;
        }

        if ($_SESSION['token'] !== $_POST['token']) {
            redirect("/");
        }

        $next();
    }
}
