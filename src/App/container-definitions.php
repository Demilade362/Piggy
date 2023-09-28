<?php

declare(strict_types=1);

use App\config\Paths;
use App\Services\{
    TransactionService,
    UserService,
    ValidatorService,
    ReceiptService
};
use Framework\Container;
use Framework\Database;
use Framework\TemplateEngine;

return [
    TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),
    ValidatorService::class => fn () => new ValidatorService(),
    Database::class => fn () => new Database(
        env("DB_DRIVER"),
        [
            'host' => env("DB_HOST"),
            'port' => env("DB_PORT"),
            'dbname' => env("DB_NAME")
        ],
        env('DB_USERNAME'),
        env('DB_PASSWORD')
    ),
    UserService::class => function (Container $container) {
        $db = $container->get(Database::class);

        return new UserService($db);
    },
    TransactionService::class => function (Container $container) {
        $db = $container->get(Database::class);

        return new TransactionService($db);
    },
    ReceiptService::class => function (Container $container) {
        $db = $container->get(Database::class);

        return new ReceiptService($db);
    },
];
