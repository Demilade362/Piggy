<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TransactionService;
use App\Services\ValidatorService;
use Framework\TemplateEngine;

class TransactionController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validate,
        private TransactionService $transactionService,
    ) {
    }

    public function index()
    {
        return $this->view->render("transactions/create.php");
    }

    public function create()
    {
        $this->validate->validateTransaction($_POST);

        $this->transactionService->create($_POST);

        return redirect("/");
    }

    public function editView(array $params)
    {
        $transaction = $this->transactionService->getTransaction($params['transaction']);

        if (!$transaction) {
            redirect("/");
        }

        return $this->view->render("transactions/edit.php", compact('transaction'));
    }

    public function edit(array $params)
    {
        $transaction = $this->transactionService->getTransaction($params['transaction']);

        if (!$transaction) {
            redirect("/");
        }

        $this->validate->validateTransaction($_POST);

        $this->transactionService->update($_POST, $transaction['id']);

        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(array $params)
    {
        $this->transactionService->delete((int) $params['transaction']);

        return redirect("/");
    }
}
