<?php
require_once __DIR__ . './../repository/PackagesRepository.php';

class Packages {
    private PackagesRepository $packagesRepository;

    public function __construct()
    {
        $this->packagesRepository = new PackagesRepository();
    }

    public function getAll(): void
    {
        $packages = $this->packagesRepository->getAll();
        include_once './views/packages.php';
    }
}