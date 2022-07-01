<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Matheus\Credeasycli\DAO\Doctrine\DoctrineEmprestimoDao;
use Matheus\Credeasycli\Helper\EntityManagerFactory;
use Matheus\Credeasycli\Service\EmprestimoService;

$dao = new DoctrineEmprestimoDao(EntityManagerFactory::getEntityManager());
$emprestimoService = new EmprestimoService($dao);

$emprestimoList = $emprestimoService->getAllEmprestimos();

$mask = "|%3.3s | %-15.15s | %-15.15s |\n";
printf($mask, 'Id', 'Valor', 'Status');
printf($mask, '--', '---------------------', '---------------------');

foreach ($emprestimoList as $emprestimo) {
    printf($mask, $emprestimo->getId(), $emprestimo->getValor(), $emprestimo->getStatus());
}
