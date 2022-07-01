<?php

namespace Matheus\Credeasycli\DAO;

use Matheus\Credeasycli\Entity\Emprestimo;

interface EmprestimoDao
{
    public function insert(Emprestimo $emprestimo): Emprestimo;

    public function getEmprestimoById(string $cpf): Emprestimo;

    public function getAllEmprestimos(): array;

    public function update(Emprestimo $emprestimo);
}