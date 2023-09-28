<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Exceptions\SessionException;
use Framework\Contracts\MiddlewareInterface;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        session_set_cookie_params(
            [
                'secure' => env('APP_ENV') === 'production',
                'httponly' => true,
                'samesite' => 'lax'
            ]
        );

        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException("Session already active");
        }


        session_start();


        if (headers_sent($filename, $line)) {
            throw new SessionException("Sessions already sent. Consider Enabling output buffering. Data outputted from {$filename} - Line: {$line}");
        }


        $next();

        session_write_close();
    }
}
