<?php

namespace Matheus\Credeasycli\DAO\Doctrine;

use Doctrine\ORM\EntityManager;
use Matheus\Credeasycli\DAO\ClienteDao;
use Matheus\Credeasycli\Entity\Cliente;

class DoctrineClienteDao implements ClienteDao
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function insert(Cliente $cliente): Cliente
    {
        $this->em->persist($cliente);
        $this->em->flush();

        return $cliente; 
    }

    public function getClienteByCpf(string $cpf): Cliente
    {
        return $this->em->find(Cliente::class, $cpf);
    }

    public function getAllClientes(): array
    {
        $clienteRepository = $this->em->getRepository(Cliente::class);
        return $clienteRepository->findAll();
    }

    public function updateEmprestimoData(string $cpf, float $valor)
    {
        $cliente = $this->em->find(Cliente::class, $cpf);
        
        $cliente->addQtdEmprestimos();
        $cliente->addTotalEmprestado($valor);

        $this->em->flush();
    }
}