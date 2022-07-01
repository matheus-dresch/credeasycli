<?php

namespace Matheus\Credeasycli\Service;

require_once __DIR__ . "/../../vendor/autoload.php";

use Matheus\Credeasycli\DAO\ClienteDao;
use Matheus\Credeasycli\Entity\Cliente;
use Matheus\Credeasycli\Entity\Emprestimo;

class ClienteService
{
    private $clienteDao;

    public function __construct(ClienteDao $clienteDao)
    {
        $this->clienteDao = $clienteDao;
    }

    public function createCliente(
        string $cpf,
        string $nome,
        string $numero,
        string $endereco,
        string $profissao,
        float $renda,
        string $email,
        string $senha
    ) {
        $cliente = new Cliente(
            $cpf,
            $nome,
            $numero,
            $endereco,
            $profissao,
            $renda,
            $email,
            $senha
        );
        
        $this->clienteDao->insert($cliente);
    }

    /**
     * @return Cliente[]
     */
    public function getAllClientes(): array
    {
        return $this->clienteDao->getAllClientes();
    }

    public function updateEmprestimoData(string $cpf, Emprestimo $emprestimo) {
        $this->clienteDao->updateEmprestimoData($cpf, $emprestimo->getValor());
    }
}
