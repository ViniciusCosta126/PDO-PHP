<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$student = new Student(
    null,
    'Vinicius Costa da Silva',
    new \DateTimeImmutable('1997-12-16')
);

echo $student->age();
