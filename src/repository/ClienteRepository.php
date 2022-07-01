<?php

namespace Matheus\Credeasycli\Repository;

use Doctrine\ORM\EntityRepository;
use Matheus\Credeasycli\Entity\Cliente;
use Matheus\Credeasycli\Entity\Emprestimo;

class ClienteRepository extends EntityRepository
{
    public function countEmprestimosClientes()
    {
        $classCliente = Cliente::class;
        $classEmprestimo = Emprestimo::class;
        $dql = "SELECT c.cpf, c.nome, count(e.id) qtd_emps FROM {$classCliente} c 
            INNER JOIN {$classEmprestimo} e
            GROUP BY c.cpf, c.nome, qtd_emps";

        $query = $this->getEntityManager()->createQuery($dql);

        $result = $query->getResult();

        foreach ($result as $item) {
            echo $result['cpf'];
        }
    }

    public function countClientes()
    {
        
    }
}