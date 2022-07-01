<?php

namespace Matheus\Credeasycli\DAO\Doctrine;

use Doctrine\ORM\EntityManager;
use Matheus\Credeasycli\DAO\EmprestimoDao;
use Matheus\Credeasycli\Entity\Emprestimo;
use Matheus\Credeasycli\Exceptions\RegistryNotFound;
use PDOException;

class DoctrineEmprestimoDao implements EmprestimoDao
{

    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function insert(Emprestimo $emprestimo): Emprestimo
    {
        $this->em->persist($emprestimo);
        $this->em->flush();
        return $emprestimo;
    }

    public function getEmprestimoById(string $id): Emprestimo
    {
        return $this->em->find(Emprestimo::class, $id);
    }

    public function getAllEmprestimos(): array
    {
        $emprestimoRepository = $this->em->getRepository(Emprestimo::class);
        return $emprestimoRepository->findAll();
    }

    public function update(Emprestimo $emprestimo)
    {
        $this->em->persist($emprestimo);
        $this->em->flush();
    }
}