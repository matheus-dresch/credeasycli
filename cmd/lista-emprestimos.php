<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Matheus\Credeasycli\DAO\Doctrine\DoctrineEmprestimoDao;
use Matheus\Credeasycli\Helper\EntityManagerFactory;
use Matheus\Credeasycli\Service\EmprestimoService;

$dao = new DoctrineEmprestimoDao(EntityManagerFactory::getEntityManager());
$emprestimoService = new EmprestimoService($dao);

$emprestimoList = $emprestimoService->getAllEmprestimos();

$consoleTable = new Console_Table();
$consoleTable->setHeaders([
    "ID",
    "CPF",
    "Valor",
    "Status",
    "Nº parcelas"
]);

/**
 * @var Emprestimo[] $emprestimoList
 */
foreach ($emprestimoList as $emprestimo) {
    $valor = $emprestimo->getValor();
    $valorFormatado = "R$ " . number_format($valor, 2, ',', '.');

    $consoleTable->addRow([
        $emprestimo->getId(),
        $emprestimo->getCliente()->getCpf(),
        $valorFormatado,
        $emprestimo->getStatus(),
        $emprestimo->getParcelas()->count()
    ]);
}

echo($consoleTable->getTable());