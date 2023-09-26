<?php

declare(strict_types=1);

use App\config\Paths;
use Dotenv\Dotenv;
use Framework\App;

use function App\config\registerMiddleware;
use function App\Routes\registerRoutes;

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

require __DIR__ . "/../../vendor/autoload.php";


$app = new App(Paths::SOURCE . "App/container-definitions.php");

registerRoutes($app);
registerMiddleware($app);

return $app;
