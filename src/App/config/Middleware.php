<?php

declare(strict_types=1);

namespace App\config;

use App\Middlewares\{
    CsrfGuardMiddleware,
    CsrfTokenMiddleware,
    FlashMiddleware,
    SessionMiddleware,
    TemplateDataMiddleware,
    ValidationExceptionsMiddleware
};
use Framework\App;

function registerMiddleware(App $app)
{
    $app->addMiddleware(CsrfGuardMiddleware::class);
    $app->addMiddleware(CsrfTokenMiddleware::class);
    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(ValidationExceptionsMiddleware::class);
    $app->addMiddleware(FlashMiddleware::class);
    $app->addMiddleware(SessionMiddleware::class);
}
