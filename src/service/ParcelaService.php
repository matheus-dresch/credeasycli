<?php

namespace Matheus\Credeasycli\Service;

use DateInterval;
use DateTimeImmutable;
use Matheus\Credeasycli\Entity\Emprestimo;
use Matheus\Credeasycli\Entity\Parcela;

class ParcelaService
{
    /**
     * @return Parcela[]
     */
    public function createParcelas(Emprestimo $emprestimo, int $numeroParcelas)
    {
        $valorParcela = $emprestimo->getValor() / $numeroParcelas;
        $dataAtual = new DateTimeImmutable();
        $dataVencimento = $dataAtual->add(new DateInterval('P1M'));

        $parcelaList = [];

        for ($i = 1; $i <= $numeroParcelas; $i++) {
            
            $parcela = new Parcela(
                $emprestimo,
                $valorParcela,
                $i,
                $dataVencimento
            );
            
            $dataVencimento = $dataVencimento->add(new DateInterval('P1M'));
            $parcelaList[] = $parcela;
        }

        return $parcelaList;
    }
}
