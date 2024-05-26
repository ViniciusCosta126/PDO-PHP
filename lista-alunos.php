<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';


$dataBasePath = __DIR__ . '/db.sqlite';
$pdo = new PDO('sqlite:' . $dataBasePath);

$statement = $pdo->query('SELECT * FROM students');

var_dump($statement->fetchAll(PDO::FETCH_CLASS, Student::class));
