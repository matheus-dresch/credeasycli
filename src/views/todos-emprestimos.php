<?php

use Matheus\Credeasycli\DAO\Doctrine\DoctrineEmprestimoDao;
use Matheus\Credeasycli\Helper\EntityManagerFactory;
use Matheus\Credeasycli\Service\EmprestimoService;

require_once __DIR__ . '/../../vendor/autoload.php';

$dao = new DoctrineEmprestimoDao(EntityManagerFactory::getEntityManager());
$emprestimoService = new EmprestimoService($dao);

$emprestimoList = $emprestimoService->getAllEmprestimos();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Listagem dos emprestimos</title>
</head>

<body>
    <h2>Listagem dos emprestimos da CredEasy</h2>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>NOME EMPRÉSTIMO</th>
            <th>CPF</th>
            <th>NOME CLIENTE</th>
            <th>VALOR</th>
            <th>DATA</th>
            <th>SITUAÇÃO</th>
        </thead>
        <tbody>
            <?php foreach ($emprestimoList as $emprestimo) { ?>
                <tr>
                    <td><?php echo $emprestimo->getId(); ?></td>
                    <td><?php echo $emprestimo->getNomeEmprestimo(); ?></td>
                    <td><?php echo $emprestimo->getCliente()->getCpf(); ?></td>
                    <td><?php echo $emprestimo->getCliente()->getNome(); ?></td>
                    <td><?php echo $emprestimo->getValor(); ?></td>
                    <td><?php echo $emprestimo->getDataSolicitacao()->format('d-m-Y'); ?></td>
                    <td><?php echo $emprestimo->getStatus(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>