<?php

namespace Viniciusc6\Pdo\Infrastructure\Repository;

use PDO;
use Viniciusc6\Pdo\Domain\Model\Student;
use Viniciusc6\Pdo\Domain\Repository\StudentRepository;

class PdoStudentRepository implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function allStudents(): array
    {
        $sqlQuery = 'SELECT * FROM students';
        $stmt = $this->connection->prepare($sqlQuery);
        return $this->hydrateStudentList($stmt);
    }

    public function studentsBirthAt(\DateTimeImmutable $birth_date): array
    {
        $sqlQuery = 'SELECT * FROM students WHERE birth_date=?;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $birth_date->format('Y-m-d'));
        return $this->hydrateStudentList($stmt);
    }

    private function hydrateStudentList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date'])
            );
        }

        return $studentList;
    }

    public function save(Student $student): bool
    {
        $sqlInsert = "INSERT INTO students (name, birth_date) VALUES(:name, :birth_date);";
        $stmt = $this->connection->prepare($sqlInsert);

        if ($stmt === false) {
            throw new \RuntimeException("Erro na query do banco");
        }

        $stmt->bindValue(':name', $student->name());
        $stmt->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));

        $success = $stmt->execute([
            ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format(format: 'Y-m-d'),
        ]);
        $student->defineId($this->connection->lastInsertId());
        return $success;
    }
    public function update(Student $student): bool
    {
        $updateQuery = 'UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id;';
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->bindValue(':name', $student->name());
        $stmt->bindValue(':birth_date', $student->birthDate()->format(format: 'Y-m-d'));
        $stmt->bindValue(':id', $student->id(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete(Student $student): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bindValue(1, $student->id(), PDO::PARAM_INT);
        return $stmt->execute();
    }
}
