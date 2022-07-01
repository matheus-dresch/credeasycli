<?php

use Matheus\Credeasycli\DAO\Doctrine\DoctrineClienteDao;
use Matheus\Credeasycli\DAO\Doctrine\DoctrineEmprestimoDao;
use Matheus\Credeasycli\DAO\Doctrine\DoctrineParcelaDao;
use Matheus\Credeasycli\Helper\EntityManagerFactory;
use Matheus\Credeasycli\Service\EmprestimoService;

require_once __DIR__ . '/../vendor/autoload.php';

$em = EntityManagerFactory::getEntityManager();

$emprestimoService = new EmprestimoService(
    new DoctrineEmprestimoDao($em), 
    new DoctrineClienteDao($em), 
    new DoctrineParcelaDao($em)
);
$emprestimo = $emprestimoService->createEmprestimo($argv[1], $argv[2], $argv[3], $argv[4], $argv[5]);

echo "Empréstimo de ID {$emprestimo->getId()} criado com sucesso.";