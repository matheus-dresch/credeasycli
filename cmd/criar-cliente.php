<?php

use Matheus\Credeasycli\DAO\Doctrine\DoctrineClienteDao;
use Matheus\Credeasycli\Helper\EntityManagerFactory;
use Matheus\Credeasycli\Service\ClienteService;

require_once __DIR__ . '/../vendor/autoload.php';

$args = array_slice($argv, 1);

$dao = new DoctrineClienteDao(EntityManagerFactory::getEntityManager());
$clienteService = new ClienteService($dao);

$clienteService->createCliente(...$args);
