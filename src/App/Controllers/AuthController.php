<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class AuthController
{
    public function __construct(
        private TemplateEngine $view
    ) {
    }

    public function registerPage()
    {
        $title = "Register";
        $this->view->render('register.php', compact('title'));
    }
}
