<?php

namespace Matheus\Credeasycli\Service;

use DateInterval;
use DateTimeImmutable;
use DomainException;
use Matheus\Credeasycli\DAO\ClienteDao;
use Matheus\Credeasycli\DAO\EmprestimoDao;
use Matheus\Credeasycli\DAO\ParcelaDao;
use Matheus\Credeasycli\Entity\Emprestimo;
use Matheus\Credeasycli\Entity\Parcela;
use Throwable;

class EmprestimoService
{
    private $emprestimoDao;
    private $clienteDao;
    private $parcelaDao;

    /**
     * @param EmprestimoDao $emprestimoDao Obrigatório
     * @param ClienteDao $clienteDao Opcional dependendo do uso
     * @param ParcelaDao $parcelaDao Opcional dependendo do uso
     */
    public function __construct(EmprestimoDao $emprestimoDao, ClienteDao $clienteDao = null, ParcelaDao $parcelaDao = null)
    {
        $this->emprestimoDao = $emprestimoDao;
        $this->clienteDao = $clienteDao;
        $this->parcelaDao = $parcelaDao;
    }

    public function getAllEmprestimos(): array
    {
        return $this->emprestimoDao->getAllEmprestimos();
    }

    public function createEmprestimo(
        string $nomeEmprestimo,
        float $valorEmprestimo,
        float $jurosEmprestimo,
        int $numeroParcelas,
        string $cpfCliente
    ): Emprestimo {
        $dataSolicitacao = new DateTimeImmutable();
        $emprestimo = new Emprestimo($nomeEmprestimo, $valorEmprestimo, $jurosEmprestimo, $dataSolicitacao);

        $cliente = $this->clienteDao->getClienteByCpf($cpfCliente);
        $cliente->addEmprestimo($emprestimo);

        $valorParcela = $emprestimo->getValor() / $numeroParcelas;

        $intervalo = new DateInterval('P1M');
        $dataVencimento = $dataSolicitacao->add($intervalo);

        for ($i = 1; $i <= $numeroParcelas; $i++) {
            $parcela = new Parcela($emprestimo, $valorParcela, $i, $dataVencimento);

            $dataVencimento->add($intervalo);
            $emprestimo->addParcela($parcela);

            $this->parcelaDao->insert($parcela);
        }

        $this->emprestimoDao->insert($emprestimo);

        return $emprestimo;
    }

    public function getEmprestimo(int $id)
    {
        return $this->emprestimoDao->getEmprestimoById($id);
    }

    public function updateStatusEmprestimo(int $id, string $status)
    {
        $statusCodes = ["SOLICITADO", "APROVADO", "REPROVADO"];
        if (!in_array($status, $statusCodes)) {
            throw new DomainException("O código de status fornecido é inválido");
        }

        $emprestimo = $this->emprestimoDao->getEmprestimoById($id);
        if ($emprestimo->getStatus() != "SOLICITADO") {
            throw new DomainException("O status do empréstimo não pode ser modificado");
        }

        $emprestimo->setStatus($status);

        $cpf = $emprestimo->getCliente()->getCpf();
        $this->clienteDao->updateEmprestimoData($cpf, $emprestimo->getValor());
        $this->emprestimoDao->update($emprestimo);
    }
}
