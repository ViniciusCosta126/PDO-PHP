<?php

use Viniciusc6\Pdo\Infrastructure\Persistence\ConnectionCreate;

require_once 'vendor/autoload.php';


$pdo = ConnectionCreate::createConnection();


$preparedStatement = $pdo->prepare("DELETE FROM students WHERE id=?;");
$preparedStatement->bindValue(1, 2, PDO::PARAM_INT);
$preparedStatement->execute();

if ($preparedStatement->execute()) {
    echo "Usuario deletado com sucesso!";
}
