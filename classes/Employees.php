<?php
require_once __DIR__ . './../repository/EmployeesRepository.php';
require_once __DIR__ . './../repository/ClientsRepository.php';

class Employees
{
    private EmployeesRepository $employeesRepository;
    private ClientsRepository $clientsRepository;

    public function __construct()
    {
        $this->employeesRepository = new EmployeesRepository();
        $this->clientsRepository = new ClientsRepository();
    }

    public function getAll(): void
    {
        $employees = $this->employeesRepository->getAllWithInfo();

        if (isset($_SESSION['flash_message'])) {
            $flashMessage = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employeeId = $_POST['employee_id'];
            if (is_numeric($employeeId)) {
                $this->employeesRepository->delete($employeeId);
                $_SESSION['flash_message'] = 'Usunięto pracownika.';
            } else {
                $_SESSION['flash_message'] = 'Błąd przy usuwaniu pracownika.';
            }
            header('Location: /?page=employees');
        }

        include_once './views/employees/employees.php';
    }

    public function getOne(): void
    {
        $employeeId = $_GET['employeeId'];
        $employee = $this->employeesRepository->getOne($employeeId);
        $clients = $this->clientsRepository->getByEmployee($employeeId);

        include_once './views/clients/clients_employee.php';
    }

    public function add(): void
    {
        include_once './views/employees/employees_add.php';
    }

    public function store(): void
    {
        $newEmployee = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
        ];

        $this->employeesRepository->add($newEmployee);

        $_SESSION['flash_message'] = 'Pracownik został dodany.';
        header('Location: /?page=employees');
    }
}