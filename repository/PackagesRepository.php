<?php
require_once __DIR__ . './../classes/Database.php';
require_once __DIR__ . '/Repository.php';

class PackagesRepository extends Repository {
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM packages");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function countPackages(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM packages");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function getTotalContractsValue(): int
    {
        $stmt = $this->db->query("SELECT SUM(packages.price) AS total_value FROM clients JOIN packages ON clients.package_id = packages.id;");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_value'] ?? 0;
    }
}