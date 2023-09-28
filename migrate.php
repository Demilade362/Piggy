<?php

use Framework\Database;

include __DIR__ . "/src/Framework/Database.php";

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'piggy'
], 'root', 'password');

$sql = file_get_contents("./database.sql");
$db->connection->query($sql) ? "Migrated Successfully" : "Error Found during migration";
