<?php

$caminhoBanco = __DIR__ . '/db.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);
echo "conectei";


$createTableSql = '
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY, 
        name TEXT, 
        birth_date TEXT);

    CREATE TABLE IF NOT EXISTS phones (
        id INTEGER PRIMARY KEY,
        area_code TEXT,
        number TEXT,
        student_id INTEGER,
        FOREIGN KEY(student_id) REFERENCES students(id)
    )
';
$pdo->exec($createTableSql);
