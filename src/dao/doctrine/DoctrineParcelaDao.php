<?php

namespace Matheus\Credeasycli\DAO\Doctrine;

use Doctrine\ORM\EntityManager;
use Matheus\Credeasycli\DAO\ParcelaDao;
use Matheus\Credeasycli\Entity\Emprestimo;
use Matheus\Credeasycli\Entity\Parcela;

class DoctrineParcelaDao implements ParcelaDao
{

    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function insert(Parcela $parcela): Parcela
    {
        $this->em->persist($parcela);
        $this->em->flush();
        
        return $parcela;
    }

    public function getParcelaById(int $id): Parcela
    {
        return $this->em->find(Emprestimo::class, $id);
    }

    public function getAllParcelas(): array
    {
        $parcelaRepository = $this->em->getRepository(Parcela::class);
        return $parcelaRepository->findAll();
    }
}