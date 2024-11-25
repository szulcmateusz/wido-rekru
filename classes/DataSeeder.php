<?php
require_once __DIR__ . './../repository/PackagesRepository.php';
require_once __DIR__ . './../repository/EmployeesRepository.php';
require_once __DIR__ . './../repository/ClientsRepository.php';

class DataSeeder
{
    private PackagesRepository $packagesRepository;
    private EmployeesRepository $employeesRepository;
    private ClientsRepository $clientsRepository;
    private Faker\Generator $faker;

    public function __construct()
    {
        $this->packagesRepository = new PackagesRepository();
        $this->employeesRepository = new EmployeesRepository();
        $this->clientsRepository = new ClientsRepository();
        $this->faker = Faker\Factory::create('pl_PL');
    }

    public function generateEmployees(): void
    {
        if (isset($_SESSION['flash_message'])) {
            $flashMessage = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
        }

        include_once './views/generate/generate_employees.php';
    }

    public function generateEmployeesPost(): void
    {
        if (is_numeric($_POST['amount'])) {

            for ($i = 0; $i < $_POST['amount']; $i++) {
                $this->employeesRepository->add([
                    'name' => $this->faker->name,
                    'email' => $this->faker->email,
                    'phone' => $this->faker->numerify('+48 ###-###-###'),
                    'created_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
                ]);
            }

            $_SESSION['flash_message'] = 'Wygenerowano rekordy pracowników.';
        } else {
            $_SESSION['flash_message'] = 'Podana wartość musi być liczbą.';
        }
        header('Location: /?page=generate_employees');
    }

    public function generateClients(): void
    {
            if (isset($_SESSION['flash_message'])) {
                $flashMessage = $_SESSION['flash_message'];
                unset($_SESSION['flash_message']);
            }

            include_once './views/generate/generate_clients.php';
    }

    public function generateClientsPost(): void {
        if (is_numeric($_POST['amount'])) {

            $packages = $this->packagesRepository->getAll();
            $employees = $this->employeesRepository->getAllWithInfo();

            for ($i = 0; $i < $_POST['amount']; $i++) {
                $randomPackageId = $packages[array_rand($packages)]['id'];
                if (count($employees) > 0) {
                    $randomEmployeeId = $employees[array_rand($employees)]['id'];
                }

                $client = [
                    'client_name' => $this->faker->name,
                    'package_id' => $randomPackageId,
                    'created_at' => $this->faker->dateTime->format('Y-m-d H:i:s'),
                    'contact_info' => [
                        'contact_names' => [$this->faker->name],
                        'contact_emails' => [$this->faker->email],
                        'contact_phones' => [$this->faker->numerify('+48 ###-###-###')],
                    ]
                ];

                if ($randomEmployeeId) {
                    $client['employees'] = [$randomEmployeeId];
                }

                $this->clientsRepository->addClient($client);
            }

            $_SESSION['flash_message'] = 'Wygenerowano rekordy klientów.';
        } else {
            $_SESSION['flash_message'] = 'Podana wartość musi być liczbą.';
        }
        header('Location: /?page=generate_clients');
    }
}