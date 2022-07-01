<?php

namespace Matheus\Credeasycli\DAO;

use Matheus\Credeasycli\Entity\Emprestimo;
use Matheus\Credeasycli\Entity\Parcela;

interface ParcelaDao
{
    public function insert(Parcela $parcela): Parcela;

    public function getParcelaById(int $id): Parcela;

    public function getAllParcelas(): array;
}