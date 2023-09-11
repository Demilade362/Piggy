<?php

declare(strict_types=1);

namespace App\Controllers;

use App\config\Paths;
use Framework\TemplateEngine;

class HomeController
{
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }

    public function index(): mixed
    {
        $title = "Piggy Framework";
        return $this->view->render("index.php", compact("title"));
    }

    public function show(): mixed
    {
        $title = "About Piggy Framework";
        return $this->view->render('about.php', compact('title'));
    }
}
