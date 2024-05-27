<?php

namespace Viniciusc6\Pdo\Infrastructure\Persistence;

use PDO;

require_once 'vendor/autoload.php';

class ConnectionCreator
{
    public static function createConnection(): PDO
    {
        $dataBasePath = __DIR__ . '/../../../db.sqlite';
        $connection = new PDO('sqlite:' . $dataBasePath);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }
}
