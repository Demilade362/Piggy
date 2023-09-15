<?php

declare(strict_types=1);

use App\config\Paths;
use Framework\App;

use function App\Middlewares\registerMiddleware;
use function App\Routes\registerRoutes;

require __DIR__ . "/../../vendor/autoload.php";


$app = new App(Paths::SOURCE . "App/container-definitions.php");

registerRoutes($app);
registerMiddleware($app);


return $app;
