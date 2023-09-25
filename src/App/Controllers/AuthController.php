<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{
    ValidatorService,
    UserService
};
use Framework\TemplateEngine;

class AuthController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validator,
        private UserService $userService
    ) {
    }

    public function registerView()
    {
        $title = "Register";
        return $this->view->render('register.php', compact('title'));
    }

    public function register()
    {
        $this->validator->validateRegister($_POST);

        $this->userService->isEmailTaken($_POST['email']);

        $this->userService->create($_POST);

        return redirect("/");
    }

    public function loginView()
    {
        $title = 'Login';
        return $this->view->render('login.php', compact('title'));
    }

    public function login()
    {
        $this->validator->validateLogin($_POST);

        $this->userService->login($_POST);

        return redirect("/");
    }

    public function logout()
    {
        $this->userService->logout();
    }
}
