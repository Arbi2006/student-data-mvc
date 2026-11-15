<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/Model.php';
class Student extends Model
{
    public function all(): array
    {
        $stmt = $this->db->prepare('SELECT id, nim, name, major, semester, gpa FROM students ORDER BY id ASC');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function find(int $id): array|false
    {
        $stmt = $this->db->prepare('SELECT id, nim, name, major, semester, gpa FROM students WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function create(array $data): bool
    {
        try {
            $stmt = $this->db->prepare(
                'INSERT INTO students (nim, name, major, semester, gpa) VALUES (:nim, :name, :major, :semester, :gpa)'
            );
            return $stmt->execute([
                ':nim' => $data['nim'],
                ':name' => $data['name'],
                ':major' => $data['major'],
                ':semester' => (int) $data['semester'],
                ':gpa' => (float) $data['gpa'],
            ]);
        } catch (PDOException) {
            return false;
        }
    }
    public function update(int $id, array $data): bool
    {
        try {
            $stmt = $this->db->prepare(
                'UPDATE students SET nim = :nim, name = :name, major = :major, semester = :semester, gpa = :gpa WHERE id = :id'
            );
            return $stmt->execute([
                ':id' => $id,
                ':nim' => $data['nim'],
                ':name' => $data['name'],
                ':major' => $data['major'],
                ':semester' => (int) $data['semester'],
                ':gpa' => (float) $data['gpa'],
            ]);
        } catch (PDOException) {
            return false;
        }
    }
    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare('DELETE FROM students WHERE id = :id');
            return $stmt->execute([':id' => $id]);
        } catch (PDOException) {
            return false;
        }
    }
}