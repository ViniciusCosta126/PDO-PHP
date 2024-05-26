<?php

use Viniciusc6\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';


$dataBasePath = __DIR__ . '/db.sqlite';
$pdo = new PDO('sqlite:' . $dataBasePath);


$student = new Student(null, "Patrick Dias", new \DateTimeImmutable('1997-12-16'));
$sqlInsert = "INSERT INTO students (name, birth_date) VALUES(:name, :birth_date);";

$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $student->name());
$statement->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));
$statement->execute();

if ($statement->execute()) {
    echo "Aluno incluido com sucesso";
}
