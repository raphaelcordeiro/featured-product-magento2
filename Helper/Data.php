<?php

namespace MagentoModules\FeaturedProduct\Helper;

use Magento\Catalog\Model\Product;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Catalog\Helper\Image as ImageHelper;

class Data extends AbstractHelper
{
    /**
     * @var ImageHelper
     */
    private ImageHelper $imageHelper;

    /**
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param ImageHelper $imageHelper
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        ImageHelper $imageHelper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->imageHelper = $imageHelper;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    final public function isFeaturedProductEnabled(): bool
    {
        return $this->getConfig('featured_product_settings/featured_product_settings/enable_featured_product');
    }

    /**
     * @return string
     */
    final public function getFeaturedProductSku(): string
    {
        return $this->getConfig('featured_product_settings/featured_product_settings/featured_product_sku');
    }

    /**
     * @param string $path
     * @param string $scopeType
     * @param int|null $scopeCode
     * @return mixed
     */
    final public function getConfig(string $path, string $scopeType = ScopeInterface::SCOPE_STORE, int $scopeCode = null): mixed
    {
        return $this->scopeConfig->getValue($path, $scopeType, $scopeCode);
    }

    /**
     * @param Product $product
     * @return string
     */
    final public function getProductImage(Product $product) : string
    {
        return $this->imageHelper->init($product, 'product_base_image')->getUrl();
    }
}
