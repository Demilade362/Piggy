<?php

declare(strict_types=1);

namespace App\Controllers;

use App\config\Paths;
use Framework\TemplateEngine;

class HomeController
{

    public function __construct(
        private TemplateEngine $view
    ) {
    }

    public function index(): mixed
    {
        return $this->view->render("index.php");
    }
}
