<?php

namespace App\Application\Services;

interface SalesServiceInterface
{
    /**
     * Cria uma nova venda com os dados fornecidos via API.
     *
     * @param array $saleData Dados das vendas.
     * @return Array|null Retorna um array com os dados da venda, nulo caso contrário.
     */
    public function createSale(array $saleData): ?Array;
}
