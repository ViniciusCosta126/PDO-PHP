<?php

namespace Viniciusc6\Pdo\Infrastructure\Persistence;

use PDO;

require_once 'vendor/autoload.php';

class ConnectionCreate
{
    public static function createConnection(): PDO
    {
        $dataBasePath = __DIR__ . '/../../.../db.sqlite';
        return new PDO('sqlite:' . $dataBasePath);
    }
}
