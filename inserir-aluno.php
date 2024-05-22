<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';


$dataBasePath = __DIR__ . '/db.sqlite';
$pdo = new PDO('sqlite:' . $dataBasePath);


$student = new Student(null, "Vinicius Costa", new \DateTimeImmutable('1997-12-16'));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES('{$student->name()}','{$student->birthDate()->format('Y-m-d')}')";

$pdo->exec($sqlInsert);
