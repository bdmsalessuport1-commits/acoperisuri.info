<?php

/**
 * Conexiune PDO la MySQL
 */

use App\Helpers\Env;

function getDbConnection(): ?PDO
{
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    $host = Env::get('DB_HOST', '127.0.0.1');
    $dbname = Env::get('DB_NAME', 'acoperisuri_info');
    $user = Env::get('DB_USER', 'root');
    $pass = Env::get('DB_PASS', '');
    $port = Env::get('DB_PORT', '3306');

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
        ]);

        return $pdo;
    } catch (PDOException $e) {
        if (Env::get('APP_DEBUG', 'false') === 'true') {
            error_log('Database connection error: ' . $e->getMessage());
        }
        return null;
    }
}
