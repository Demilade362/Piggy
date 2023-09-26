<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 1);


include __DIR__ . "/../src/App/utilityFunctions.php";
$app = include __DIR__ . "/../src/App/bootstrap.php";

echo $app->run();
