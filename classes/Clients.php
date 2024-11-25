<?php
require_once __DIR__ . './../repository/ClientsRepository.php';
require_once __DIR__ . './../repository/PackagesRepository.php';
require_once __DIR__ . './../repository/EmployeesRepository.php';

class Clients
{
    private ClientsRepository $clientRepository;
    private PackagesRepository $packagesRepository;
    private EmployeesRepository $employeesRepository;

    public function __construct()
    {
        $this->clientRepository = new ClientsRepository();
        $this->packagesRepository = new PackagesRepository();
        $this->employeesRepository = new EmployeesRepository();
    }

    public function getAllWithInfo(): void
    {
        $clients = $this->clientRepository->getAllWithInfo();

        if (isset($_SESSION['flash_message'])) {
            $flashMessage = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clientId = $_POST['client_id'];
            if (is_numeric($clientId)) {
                $this->clientRepository->delete($clientId);
                $_SESSION['flash_message'] = 'Usunięto klienta.';
            } else {
                $_SESSION['flash_message'] = 'Błąd przy usuwaniu klienta.';
            }
            header('Location: /?page=clients');
        }
        include_once './views/clients/clients.php';
    }

    public function addClient(): void
    {
        $packages = $this->packagesRepository->getAll();
        $employees = (new EmployeesRepository())->getAllWithInfo();

        include_once './views/clients/clients_add.php';
    }
    public function store(): void
    {
        $newClient = [
            'client_name' => $_POST['name'],
            'package_id' => $_POST['package_id'],
            'employees' => $_POST['employees'] ?? null,
            'contact_info' => [
                'contact_names' => $_POST['contact_names'],
                'contact_emails' => $_POST['contact_emails'],
                'contact_phones' => $_POST['contact_phones'],
            ],
        ];
        $this->clientRepository->addClient($newClient);
        $_SESSION['flash_message'] = 'Klient został dodany.';

        header('Location: /?page=clients');
    }
}