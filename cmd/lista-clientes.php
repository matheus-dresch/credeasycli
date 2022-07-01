<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Matheus\Credeasycli\DAO\Doctrine\DoctrineClienteDao;
use Matheus\Credeasycli\Helper\EntityManagerFactory;
use Matheus\Credeasycli\Service\ClienteService;

$em = EntityManagerFactory::getEntityManager();

$dao = new DoctrineClienteDao($em);
$clienteService = new ClienteService($dao);

$todosClientes = $clienteService->getAllClientes();

foreach ($todosClientes as $cliente) {
    echo "CPF: {$cliente->getCpf()},\nNOME: {$cliente->getNome()}\n" . PHP_EOL;
}