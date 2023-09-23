<?php

declare(strict_types=1);

use App\config\Paths;
use App\Services\ValidatorService;
use Framework\TemplateEngine;
use Framework\Validator;

return [
    TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),
    ValidatorService::class => fn () => new ValidatorService(),
];
