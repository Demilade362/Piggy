<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ValidatorService;
use Framework\TemplateEngine;

class AuthController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validator
    ) {
    }

    public function registerPage()
    {
        $title = "Register";
        $this->view->render('register.php', compact('title'));
    }

    public function register()
    {
        $this->validator->validateRegister($_POST);
    }
}
