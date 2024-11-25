<?php
require_once __DIR__ . './../classes/Database.php';
require_once __DIR__ . '/Repository.php';

class ClientsRepository extends Repository
{
    public function getAllWithInfo(): array
    {
        $sql = "SELECT
            c.name AS client_name,
            c.created_at,
            c.id AS client_id,
            p.name AS package_name,
            GROUP_CONCAT(DISTINCT CONCAT(co.name, '|', COALESCE(co.email, 'Brak e-maila'), '|', COALESCE(co.phone, 'Brak telefonu')) SEPARATOR ';') AS contact_persons,
            GROUP_CONCAT(DISTINCT CONCAT(e.name, '|', e.id) SEPARATOR ';') AS client_employees
        FROM clients c
        LEFT JOIN packages p ON c.package_id = p.id
        LEFT JOIN contacts co ON co.client_id = c.id
        LEFT JOIN client_employee ce ON ce.client_id = c.id
        LEFT JOIN employees e ON ce.employee_id = e.id
        GROUP BY c.id, c.name, p.name;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmployee(int $id): array
    {
        $sql = "SELECT
            c.name AS client_name,
            c.created_at,
            c.id AS client_id,
            p.name AS package_name,
            GROUP_CONCAT(DISTINCT CONCAT(co.name, '|', COALESCE(co.email, 'Brak e-maila'), '|', COALESCE(co.phone, 'Brak telefonu')) SEPARATOR ';') AS contact_persons,
            GROUP_CONCAT(DISTINCT e.name SEPARATOR ', ') AS client_employees
        FROM clients c
        LEFT JOIN packages p ON c.package_id = p.id
        LEFT JOIN contacts co ON co.client_id = c.id
        LEFT JOIN client_employee ce ON ce.client_id = c.id
        LEFT JOIN employees e ON ce.employee_id = e.id
        WHERE ce.employee_id = $id
        GROUP BY c.id, c.name, p.name;";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addClient($client): void
    {
        $stmt = $this->db->prepare("INSERT INTO clients (name, package_id, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");
        $stmt->execute([$client['client_name'], $client['package_id']]);
        $client_id = $this->db->lastInsertId();

        $employees = $client['employees'];
        if ($employees) {
            foreach ($employees as $employee) {
                $stmt = $this->db->prepare("INSERT INTO client_employee (client_id, employee_id) VALUES (?, ?)");
                $stmt->execute([$client_id, $employee]);
            }
        }

        $contacts = $client['contact_info'];
        if ($contacts['contact_names'][0]) {
            foreach ($contacts['contact_names'] as $index => $name) {
                $email = $contacts['contact_emails'][$index];
                $phone = $contacts['contact_phones'][$index];

                $stmt = $this->db->prepare("INSERT INTO contacts (client_id, name, email, phone, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
                $stmt->execute([$client_id, $name, $email, $phone]);
            }
        }
    }

    public function countClients(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM clients");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM clients WHERE id = ?");
        $stmt->execute([$id]);
    }
}