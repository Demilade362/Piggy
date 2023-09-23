<?php

declare(strict_types=1);

namespace App\config;

use App\Middlewares\{
    FlashMiddleware,
    SessionMiddleware,
    TemplateDataMiddleware,
    ValidationExceptionsMiddleware
};
use Framework\App;

function registerMiddleware(App $app)
{
    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(ValidationExceptionsMiddleware::class);
    $app->addMiddleware(FlashMiddleware::class);
    $app->addMiddleware(SessionMiddleware::class);
}
