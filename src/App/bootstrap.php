<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use Dotenv\Dotenv;
use App\config\Paths;


use function App\config\registerMiddleware;
use function App\Routes\registerRoutes;


$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();



$app = new App(Paths::SOURCE . "App/container-definitions.php");

registerRoutes($app);
registerMiddleware($app);

return $app;
