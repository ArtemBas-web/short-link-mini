<?php

require_once 'App/MyPDO.php';

use App\MyPDO;

$pdo = new MyPDO();
function migrate($pdo)
{
    $sql = 'CREATE TABLE IF NOT EXISTS urls (
        id INT AUTO_INCREMENT PRIMARY KEY,
        short_code VARCHAR(6) NOT NULL UNIQUE,
        long_url TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';
    $pdo->exec($sql);
}

try {
    migrate($pdo);
} catch (Exception $e) {
    die('Ошибка запроса к базе данных: ' . $e->getMessage());
}
