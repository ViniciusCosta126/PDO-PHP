<?php
require_once('vendor/autoload.php');

use Viniciusc6\Pdo\Domain\Model\Student;
use Viniciusc6\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Viniciusc6\Pdo\Infrastructure\Repository\PdoStudentRepository;



$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);


// Realizo processos de definicao da turma
$connection->beginTransaction();

try {
    $aStudent = new Student(null, "Nico Steppat", new DateTimeImmutable("1985-05-01"));
    $studentRepository->save($aStudent);

    $anotherStudent = new Student(null, "Sergio Lopes", new DateTimeImmutable("1985-05-01"));
    $studentRepository->save($anotherStudent);

    $connection->commit();
} catch (\PDOException $e) {
    echo $e->getMessage();
    $connection->rollback();
}
