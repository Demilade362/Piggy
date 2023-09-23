<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;

class ValidationExceptionsMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        try {
            $next();
        } catch (ValidationException $e) {
            $oldFormData = $_POST;
            $excludedFields = ['password', 'confirmPassword'];

            $formattedData = array_diff_key(
                $oldFormData,
                array_flip($excludedFields)
            );

            $_SESSION['errors'] = $e->errors;
            $_SESSION['oldFormData'] = $formattedData;
            $referer = $_SERVER['HTTP_REFERER'];
            redirect($referer);
        }
    }
}
