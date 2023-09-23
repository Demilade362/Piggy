<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException;

class Database
{

    public PDO $connection;

    public function __construct(string $driver, array $data, string $username, string $password)
    {
        $config = http_build_query(
            data: $data,
            arg_separator: ";",
        );

        $dsn = "{$driver}:{$config}";

        try {
            $this->connection = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            exit("Couldn't Connect to the database\n");
        }
    }
}
