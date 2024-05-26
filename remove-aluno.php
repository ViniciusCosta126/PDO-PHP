<?php

use Viniciusc6\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';


$dataBasePath = __DIR__ . '/db.sqlite';
$pdo = new PDO('sqlite:' . $dataBasePath);


$preparedStatement = $pdo->prepare("DELETE FROM students WHERE id=?;");
$preparedStatement->bindValue(1, 2, PDO::PARAM_INT);
$preparedStatement->execute();

if ($preparedStatement->execute()) {
    echo "Usuario deletado com sucesso!";
}
