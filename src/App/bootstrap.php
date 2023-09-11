<?php

declare(strict_types=1);

use Framework\App;

require __DIR__ . "/../../vendor/autoload.php";


$app = new App();

require __DIR__ . "/../App/Routes/web.php";


return $app;
