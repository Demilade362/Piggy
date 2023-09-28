<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
    public function __construct(
        private Database $db
    ) {
    }

    public function create(array $formData)
    {

        $formattedDate = "{$formData['date']} 00:00:00";
        $this->db->query(
            "INSERT INTO transactions (description, amount, date, user_id) VALUES(:description, :amount, :date, :user_id)",
            [
                'description' => $formData['description'],
                'amount' => $formData['amount'],
                'date' => $formattedDate,
                'user_id' => $_SESSION['user']
            ]
        );
    }

    public function getTransactions(int $length, int $offset)
    {
        $searchParam = addcslashes($_GET['s'] ?? '', "%_");
        $params = [
            'user_id' => $_SESSION['user'],
            'description' => "%{$searchParam}%"
        ];
        $transactions = $this->db->query(
            "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') as formatted_date
             FROM transactions
             WHERE user_id = :user_id AND description  LIKE :description LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();

        $transactions = array_map(function ($transaction) {
            $transaction['receipts'] = $this->db->query(
                "SELECT * FROM receipts WHERE transaction_id = :transaction_id",
                [
                    'transaction_id' => $transaction['id']
                ]
            )->findAll();

            return $transaction;
        }, $transactions);

        $transactionCount = $this->db->query(
            "SELECT COUNT(*)
             FROM transactions
             WHERE user_id = :user_id AND description  LIKE :description LIMIT {$length} OFFSET {$offset}",
            $params
        )->count();

        return [$transactions, $transactionCount];
    }


    public function getTransaction(string $id)
    {
        $transaction = $this->db->query(
            "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') as formatted_date FROM transactions WHERE id = :id AND user_id = :user_id",
            [
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        )->find();

        return $transaction;
    }

    public function update(array $formData, int $id)
    {
        $formatted_date = "{$formData['date']} 00:00:00";
        $this->db->query(
            'UPDATE transactions SET description = :description, amount = :amount, date = :date WHERE id = :id AND user_id = :user_id',
            [
                'description' => $formData['description'],
                'amount' => $formData['amount'],
                'date' => $formatted_date,
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        );
    }

    public function delete(int $id)
    {
        $this->db->query(
            'DELETE FROM transactions WHERE id = :id AND user_id = :user_id',
            [
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        );
    }
}
