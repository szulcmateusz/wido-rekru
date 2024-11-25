<?php

class Render
{
    public static function renderTemplate(): void
    {
        require_once __DIR__ . './../views/template.php';
    }

    public static function renderContent(): void
    {
        $page = $_GET['page'] ?? null;
        switch ($page) {
            case 'clients':
                include_once './classes/Clients.php';
                if (isset($_GET['employeeId']) && $_GET['employeeId']) {
                    include_once './classes/Employees.php';
                    (new Employees())->getOne();
                    break;
                }
                (new Clients())->getAllWithInfo();
                break;
            case 'clients_add':
                include_once './classes/Clients.php';
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new Clients())->store();
                    break;
                }
                (new Clients())->addClient();

                break;
            case 'employees':
                include_once './classes/Employees.php';
                (new Employees())->getAll();
                break;
            case 'employee_add':
                include_once './classes/Employees.php';

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new Employees())->store();
                    break;
                }
                (new Employees())->add();
                break;
            case 'packages':
                include_once './classes/Packages.php';
                (new Packages())->getAll();
                break;
            case 'generate_employees':
                include_once './classes/DataSeeder.php';

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new DataSeeder())->generateEmployeesPost();
                    break;
                }

                (new DataSeeder())->generateEmployees();
                break;
            case 'generate_clients':
                include_once './classes/DataSeeder.php';

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new DataSeeder())->generateClientsPost();
                    break;
                }

                (new DataSeeder())->generateClients();
                break;
            default:
                include_once './classes/Dashboard.php';
                (new Dashboard())->index();
                break;
        }
    }
}