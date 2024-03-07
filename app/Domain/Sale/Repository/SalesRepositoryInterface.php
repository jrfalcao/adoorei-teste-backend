<?php

namespace App\Domain\Sale\Repository;

use App\Domain\Sale\Entity\Sales;
use App\Infrastructure\Eloquent\SaleProduct;

interface SalesRepositoryInterface
{
    /**
     * Busca uma venda pelo ID
     *
     * @param int $id
     * @return Array|null Retorna um array com uma venda, nulo caso contrário.
     */
    public function find(int $id): ?Array;

    /**
     * Cria uma nova venda
     *
     * @param array $saleData Array contendo os dados da venda
     * @return Sales|array Retorna o objeto Sales da venda criada ou um array com erros
     */
    public function create(array $saleData): Sales|array;

    /**
     * Atualiza o valor total de uma venda
     *
     * @param int $saleId Identificador da venda
     * @param float $amount Novo valor total da venda
     * @return Array|null Retorna array em caso de sucesso, null se falhar
     */
    public function update(int $saleId, float $amount): Array|null;

    /**
     * Exclui uma venda
     *
     * @param int $id Identificador da venda
     * @return bool Retorna true em caso de sucesso, false se falhar
     */
    public function destroy(int $id): bool;

    /**
     * Salva os produtos associados a uma venda
     *
     * @param array $data Array contendo os dados da associação entre produtos e vendas
     * @return bool Retorna true em caso de sucesso, false se falhar
     */
    public function saveProductsSale(array $data): bool;

    /**
     * Obtém todas as vendas dentro de um período
     *
     * @param string $start_date Data de início do período (formato YYYY-MM-DD)
     * @param string $end_date Data final do período (formato YYYY-MM-DD)
     * @return array Retorna um array com os dados de todas as vendas no período
     */
    public function getByPeriod(string $start_date, string $end_date): array;

    /**
     * Obtém os detalhes da associação entre uma venda e um produto
     *
     * @param int $saleId Identificador da venda
     * @param int $product_id Identificador do produto
     * @return array|null Retorna SaleProduct com os detalhes da associação ou null se não for encontrada
     */
    public function getSaleProd(int $saleId, int $product_id): ?SaleProduct;

    /**
     * Salva ou atualiza os dados da associação entre uma venda e um produto
     *
     * @param int $saleId Identificador da venda
     * @param int $prodId Identificador do produto
     * @param int $quantity Quantidade do produto
     * @param float $price Preço do produto na venda
     * @return SaleProduct Retorna SaleProduct em caso de sucesso, null se falhar
     */
    public function saveOrUpdateSaleProd(int $saleId, int $prodId, int $quantity, float $price): ?SaleProduct;
}
