<?php

use Matheus\Credeasycli\DAO\Doctrine\DoctrineClienteDao;
use Matheus\Credeasycli\Helper\EntityManagerFactory;
use Matheus\Credeasycli\Service\ClienteService;

require_once __DIR__ . '/../../vendor/autoload.php';

$dao = new DoctrineClienteDao(EntityManagerFactory::getEntityManager());
$clienteService = new ClienteService($dao);

$clienteList = $clienteService->getAllClientes();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Listagem dos clientes</title>
</head>

<body>
    <h2>Listagem dos clientes da CredEasy</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <th>CPF</th>
            <th>NOME</th>
            <th>RENDA</th>
            <th>QTD DE EMP</th>
            <th>VALOR TOTAL</th>
        </thead>
        <tbody>
            <?php foreach ($clienteList as $cliente) { ?>
                <tr>
                    <td>
                        <?php echo $cliente->getCpf(); ?>
                    </td>
                    <td>
                        <?php echo $cliente->getNome(); ?>
                    </td>
                    <td>
                        <?php echo $cliente->getRenda(); ?>
                    </td>
                    <td>
                        <?php echo $cliente->getQtdEmprestimos(); ?>
                    </td>
                    <td>
                        <?php echo $cliente->getTotalEmprestado(); ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>