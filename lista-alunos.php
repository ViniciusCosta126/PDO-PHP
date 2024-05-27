<?php
require_once 'vendor/autoload.php';

use Viniciusc6\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Viniciusc6\Pdo\Infrastructure\Repository\PdoStudentRepository;

$pdo = ConnectionCreator::createConnection();
$repository = new PdoStudentRepository($pdo);
$studentList = $repository->allStudents();

var_dump($studentList);
