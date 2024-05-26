<?php

namespace Viniciusc6\Pdo\Domain\Repository;

use Viniciusc6\Pdo\Domain\Model\Student;

interface StudenteRepository
{

    public function allStudents(): array;

    public function studentsBirthAt(\DateTimeImmutable $birth_date): array;

    public function save(Student $student): bool;

    public function delete(Student $student): bool;
}
