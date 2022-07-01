<?php

namespace Matheus\Credeasycli\DAO;

use Matheus\Credeasycli\Entity\Cliente;

interface ClienteDao
{
    public function insert(Cliente $cliente): Cliente;

    public function getClienteByCpf(string $cpf): Cliente;

    public function getAllClientes(): array;

    public function updateEmprestimoData(string $cpf, float $valor);
}