<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Exceptions\SessionException;
use Framework\Contracts\MiddlewareInterface;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {

        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException("Session already active");
        }

        if (headers_sent($filename, $line)) {
            throw new SessionException("Sessions already sent. Consider Enabling output buffering. Data outputted from {$filename} - Line: {$line}");
        }
        session_set_cookie_params(
            [
                'secure' => 'production',
                'httponly' => true,
                'samesite' => 'lax'

            ]
        );

        session_start();

        $next();

        session_write_close();
    }
}
