<?php

namespace App\Application\Services;

use App\Domain\Sale\Entity\Sales;

interface SalesServiceInterface
{
    /**
     * Cria uma nova venda com os dados fornecidos via API.
     *
     * @param array $saleData Dados das vendas.
     * @return Sales|null Retorna um array com os dados da venda, nulo caso contrário.
     */
    public function createSale(array $saleData): Sales|Array;

    /**
     * Busca vendas de um dia ou por período
     *
     * @param array
     * @return Array|null Retorna um array com as vendas, nulo caso contrário.
     */
    public function getSales($data): ?Array;

    /**
     * Busca uma venda pelo ID
     *
     * @param int $id
     * @return Array|null Retorna um array com uma venda, nulo caso contrário.
     */
    public function find(int $id): ?Array;

    /**
     * Deleta uma venda pelo ID
     *
     * @param int $id
     */
    public function destroy($id);

    /**
     * Update venda
     *
     * @param int $id
     */
    public function updateSale($saleId, $saleData);
}
