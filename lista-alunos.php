<?php
require_once 'vendor/autoload.php';

use Viniciusc6\Pdo\Domain\Model\Student;
use Viniciusc6\Pdo\Infrastructure\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::createConnection();

$statement = $pdo->query('SELECT * FROM students');

$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);

$studentList = [];

foreach ($studentDataList as $studentData) {
    $studentList = new Student(
        $studentData['id'],
        $studentData['name'],
        new \DateTimeImmutable($studentData['birth_date']),
    );
}

var_dump($studentList);
