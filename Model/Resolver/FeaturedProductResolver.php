<?php

namespace MagentoModules\FeaturedProduct\Model\Resolver;

use MagentoModules\FeaturedProduct\Model\FeaturedProduct;
use MagentoModules\FeaturedProduct\Helper\Data as FeaturedProductHelper;
use Magento\Framework\Pricing\Helper\Data as PriceHelper;

class FeaturedProductResolver
{
    /**
     * @param FeaturedProduct $featuredProduct
     * @param PriceHelper $priceHelper
     * @param FeaturedProductHelper $featuredProductHelper
     */
    public function __construct(
        private readonly FeaturedProduct $featuredProduct,
        private readonly PriceHelper $priceHelper,
        private readonly FeaturedProductHelper $featuredProductHelper
    ) {
    }

    /**
     * @return array
     */
    final public function resolver() : array{
        $product = $this->featuredProduct->getFeaturedProduct();
        $result = [];
        if($product){
            $result = [
                'name'  => $product->getName(),
                'price' => $this->priceHelper->currency($product->getPrice(), true, false),
                'stock' => $this->featuredProduct->getQuantity(),
                'image' => $this->featuredProductHelper->getProductImage($product),
                'url'   => $product->getProductUrl()
            ];
        }
        return $result;
    }
}
