<?php
require_once __DIR__ . './../classes/Database.php';
require_once __DIR__ . '/Repository.php';

class EmployeesRepository extends Repository {
    public function getAllWithInfo(): array {
        $sql = "SELECT * from employees";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne(int $id): array {
        $sql = "SELECT * from employees WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function add(array $employee): void {
        $stmt = $this->db->prepare("INSERT INTO employees (name, email, phone, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
        $stmt->execute([$employee['name'], $employee['email'], $employee['phone']]);
    }
    public function countEmployees(): int {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM employees");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM employees WHERE id = ?");
        $stmt->execute([$id]);
    }
}