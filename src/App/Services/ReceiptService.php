<?php

declare(strict_types=1);

namespace App\Services;

use App\config\Paths;
use Framework\Database;
use Framework\Exceptions\ValidationException;

class ReceiptService
{
    public function __construct(
        private Database $db
    ) {
    }

    public function validateFile(?array $file)
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new ValidationException(
                [
                    'receipt' => ["Failed to upload file"]
                ]
            );
        }

        $maxFileSizeMb = 3 * 1024 * 1024;

        if ($file['size'] > $maxFileSizeMb) {
            throw new ValidationException(
                [
                    'receipt' => ["Failed Size too Large"]
                ]
            );
        }

        $originalFIleName = $file['name'];

        if (!preg_match("/^[A-za-z0-9\s._-]+$/", $originalFIleName)) {
            throw new ValidationException([
                'receipt' => ['Invalid File Name']
            ]);
        }

        $clientMimeType = $file['type'];
        $allowedMimeType = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];

        if (!in_array($clientMimeType, $allowedMimeType)) {
            throw new ValidationException([
                'receipt' => ['Invalid Mime Type e.g jpg, jpeg, png, pdf']
            ]);
        }
    }

    public function upload(array $file, int $transaction)
    {
        $fileMimeType = pathinfo($file['name'], PATHINFO_EXTENSION);

        $randomFileName = bin2hex(random_bytes(20)) . ".{$fileMimeType}";

        $uploadedFile = Paths::STORAGE_PATH . "/" . $randomFileName;

        if (!move_uploaded_file($file['tmp_name'], $uploadedFile)) {
            throw new ValidationException([
                'receipt' => ["Failed to Upload File"]
            ]);
        }

        $this->db->query(
            "INSERT INTO receipts(orginal_filename, storage_filename, media_type, transaction_id) VALUES(:original_filename, :storage_filename, :media_type, :transaction_id)",
            [
                "original_filename" => $file['name'],
                "storage_filename" => $uploadedFile,
                'media_type' => $file['type'],
                'transaction_id' => $transaction,
            ]
        );
    }

    public function getReceipt(string $id)
    {
        $receipt = $this->db->query(
            "SELECT * FROM receipts WHERE id = :id",
            [
                'id' => $id
            ]
        )->find();

        return $receipt;
    }

    public function read(array $receipt)
    {
        $filePath = Paths::STORAGE_PATH . '/' . $receipt['storage_filename'];

        if (!file_exists($filePath)) {
            redirect("/");
        }

        header("Content-Disposition : inline;filename={$receipt['original_filename']}");
        header("Content-Type: {$receipt['media_type']}");

        readfile($filePath);
    }

    public function delete(array $receipt)
    {
        $filePath = Paths::STORAGE_PATH . "/" . $receipt['storage_filename'];

        unlink($filePath);

        $this->db->query(
            "DELETE FROM transactions WHERE id = :id",
            [
                'id' => $receipt['id']
            ]
        );
    }
}
