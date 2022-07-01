<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Matheus\Credeasycli\DAO\Doctrine\DoctrineClienteDao;
use Matheus\Credeasycli\DAO\Doctrine\DoctrineEmprestimoDao;
use Matheus\Credeasycli\Helper\EntityManagerFactory;
use Matheus\Credeasycli\Service\EmprestimoService;

$em = EntityManagerFactory::getEntityManager();
$clienteDao = new DoctrineClienteDao($em);
$emprestimoDao = new DoctrineEmprestimoDao($em);

$emprestimoService = new EmprestimoService($emprestimoDao, $clienteDao);

try {
    $emprestimoService->updateStatusEmprestimo($argv[1], $argv[2]);

} catch (DomainException $e) {
    $erroAnterior = $e->getPrevious() ? $e->getPrevious()->getMessage() : "sem erros anteriores";
    echo "!!! Houve um erro ao processar sua solicitação: {$e->getMessage()}\n!!! Erro anterior: {$erroAnterior}";
}
