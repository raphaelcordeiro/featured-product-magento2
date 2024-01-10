<?php
namespace MagentoModules\FeaturedProduct\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use MagentoModules\FeaturedProduct\Helper\Data;
use Magento\InventoryApi\Api\GetSourceItemsBySkuInterface;

class FeaturedProduct
{
    /**
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param GetSourceItemsBySkuInterface $getSourceItemsBySku
     * @param Data $helperData
     */
    public function __construct(
        private readonly ProductRepositoryInterface   $productRepository,
        private readonly SearchCriteriaBuilder        $searchCriteriaBuilder,
        private readonly GetSourceItemsBySkuInterface $getSourceItemsBySku,
        private readonly Data                         $helperData
    ) {
    }

    /**
     * Obtém quantidade em estoque do produto em destaque
     *
     * @return int
     */
    final public function getQuantity(): int
    {
        $sku = $this->helperData->getFeaturedProductSku();

        if (empty($sku)) {
            return 0;
        }

        $sourceItems = $this->getSourceItemsBySku->execute($sku);

        return count($sourceItems) > 0 ? array_shift($sourceItems)->getQuantity() : 0;
    }

    /**
     * Carrega produto em destaque
     *
     * @return false|mixed|null
     */
    final public function getFeaturedProduct(): mixed
    {
        $sku = $this->helperData->getFeaturedProductSku();

        if (empty($sku)) {
            return null;
        }

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('sku', $sku, 'eq')
            ->setPageSize(1)
            ->create();

        $products = $this->productRepository->getList($searchCriteria)->getItems();

        return count($products) > 0 ? array_shift($products) : null;
    }

}
