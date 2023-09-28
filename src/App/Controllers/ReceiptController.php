<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ReceiptService;
use Framework\TemplateEngine;
use App\Services\TransactionService;


class ReceiptController
{
    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService,
        private ReceiptService $receiptService
    ) {
    }

    public function uploadView(array $params)
    {
        $transaction = $this->transactionService->getTransaction($params['transaction']);

        if (!$transaction) {
            redirect("/");
        }

        return $this->view->render("receipts/create.php");
    }

    public function upload(array $params)
    {
        $transaction = $this->transactionService->getTransaction($params['transaction']);

        if (!$transaction) {
            redirect("/");
        }

        $receiptFile = $_FILES['receipt'] ?? null;

        $this->receiptService->validateFile($receiptFile);
        $this->receiptService->upload($receiptFile, $transaction['id']);


        redirect("/");
    }

    public function download(array $params)
    {
        $transaction = $this->transactionService->getTransaction($params['transaction']);

        if (empty($transaction)) {
            redirect("/");
        }

        $receipt = $this->receiptService->getReceipt($params['receipt']);

        if (empty($receipt)) {
            redirect("/");
        }

        if ($receipt['transaction_id'] !== $transaction['id']) {
            redirect("/");
        }

        $this->receiptService->read($receipt);
    }

    public function deleteReceipt(array $params)
    {
        $transaction = $this->transactionService->getTransaction($params['transaction']);

        if (empty($transaction)) {
            redirect("/");
        }

        $receipt = $this->receiptService->getReceipt($params['receipt']);

        if (empty($receipt)) {
            redirect("/");
        }

        if ($receipt['transaction_id'] !== $transaction['id']) {
            redirect("/");
        }

        $this->receiptService->delete($receipt);

        return redirect("/");
    }
}
