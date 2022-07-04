<?php

use Matheus\Credeasycli\DAO\Doctrine\DoctrineClienteDao;
use Matheus\Credeasycli\Helper\EntityManagerFactory;
use Matheus\Credeasycli\Service\ClienteService;

require_once __DIR__ . "/../vendor/autoload.php";

$em = EntityManagerFactory::getEntityManager();

$dao = new DoctrineClienteDao($em);
$clienteService = new ClienteService($dao);

$clientes = $clienteService->getAllClientes();

foreach ($clientes as $cliente) {
    echo "CPF: {$cliente->getCpf()}
    -> NOME: {$cliente->getNome()}
    -> QTD: {$cliente->getQtdEmprestimos()}
    -> VALOR: {$cliente->getTotalEmprestado()}\n" . PHP_EOL;;
}