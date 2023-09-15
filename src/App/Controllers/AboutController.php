<?php

declare(strict_types=1);

namespace App\Controllers;

use App\config\Paths;
use Framework\TemplateEngine;

class AboutController
{

    public function __construct(
        private TemplateEngine $view
    ) {
    }

    public function index()
    {
        $title = "About Page";
        return $this->view->render("about.php", compact("title"));
    }
}
