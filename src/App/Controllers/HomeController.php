<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TransactionService;
use Framework\TemplateEngine;

class HomeController
{

    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService
    ) {
    }

    public function index(): mixed
    {
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 4;
        $offset = ($page - 1) * $length;
        $searchParam = $_GET['s'] ?? null;

        [$transactions, $count] = $this->transactionService->getTransactions($length, $offset);

        $lastPage = ceil($count / $length);

        $pages = $lastPage ? range(1, $lastPage) : [];


        $pageLinks = array_map(
            fn ($pageNum) => http_build_query([
                "p" => $pageNum,
                "s" => $searchParam
            ]),
            $pages
        );


        return $this->view->render("index.php", [
            'transactions' => $transactions,
            'currentPage' => $page,
            'previousPageQuery' => http_build_query(
                [
                    'p' => $page - 1,
                    's' => $searchParam
                ]
            ),
            'lastPage' => $lastPage,
            'nextPageQuery' => http_build_query([
                'p' => $page + 1,
                's' => $searchParam
            ]),
            'pageLinks' => $pageLinks,
            'searchParam' => $searchParam
        ]);
    }
}
