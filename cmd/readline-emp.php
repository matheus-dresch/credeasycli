<?php

use Matheus\Credeasycli\DAO\Doctrine\DoctrineClienteDao;
use Matheus\Credeasycli\DAO\Doctrine\DoctrineEmprestimoDao;
use Matheus\Credeasycli\DAO\Doctrine\DoctrineParcelaDao;
use Matheus\Credeasycli\Helper\EntityManagerFactory;
use Matheus\Credeasycli\Service\EmprestimoService;

require_once __DIR__ . '/../vendor/autoload.php';

$em = EntityManagerFactory::getEntityManager();

$nomeEmp = readline("Nome do empréstimo: ");
$valorEmprestimo = floatval(readline("Valor do empréstimo: "));
$taxaJuros = floatval(readline("Taxa de juros: "));
$qtdParcelas = intval(readline("Quantidade de parcelas: "));
$cpfCliente = readline("CPF do cliente (com . e -): ");

$emprestimoService = new EmprestimoService(
    new DoctrineEmprestimoDao($em), 
    new DoctrineClienteDao($em), 
    new DoctrineParcelaDao($em)
);
$emprestimo = $emprestimoService->createEmprestimo($nomeEmp, $valorEmprestimo, $taxaJuros, $qtdParcelas, $cpfCliente);

echo "Empréstimo de ID {$emprestimo->getId()} criado com sucesso.";