<?php
require_once __DIR__ . './../repository/ClientsRepository.php';
require_once __DIR__ . './../repository/EmployeesRepository.php';
require_once __DIR__ . './../repository/PackagesRepository.php';

class Dashboard
{
    private ClientsRepository $clientRepository;
    private EmployeesRepository $employeesRepository;
    private PackagesRepository $packagesRepository;

    public function __construct()
    {
        $this->clientRepository = new ClientsRepository();
        $this->employeesRepository = new EmployeesRepository();
        $this->packagesRepository = new PackagesRepository();
    }

    public function index(): void
    {
        $countClients = $this->clientRepository->countClients();
        $countEmployees = $this->employeesRepository->countEmployees();
        $countPackages = $this->packagesRepository->countPackages();
        $totalValue = $this->packagesRepository->getTotalContractsValue();

        include_once './views/dashboard.php';
    }
}