<?php

use Viniciusc6\Pdo\Domain\Model\Student;
use Viniciusc6\Pdo\Infrastructure\Persistence\ConnectionCreate;

require_once 'vendor/autoload.php';


$dataBasePath = __DIR__ . '/db.sqlite';
$pdo = ConnectionCreate::createConnection();


$student = new Student(null, "Teste Dias", new \DateTimeImmutable('1997-12-16'));
$sqlInsert = "INSERT INTO students (name, birth_date) VALUES(:name, :birth_date);";

$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $student->name());
$statement->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));
$statement->execute();

if ($statement->execute()) {
    echo "Aluno incluido com sucesso";
}
