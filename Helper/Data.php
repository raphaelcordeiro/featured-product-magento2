<?php

namespace MagentoModules\FeaturedProduct\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\View\Asset\Repository as AssetRepository;

class Data extends AbstractHelper
{

    /**
     * @param AssetRepository $assetRepo
     * @param StoreManagerInterface $storeManager
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private readonly AssetRepository $assetRepo,
        private readonly StoreManagerInterface $storeManager,
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * Checa se o módulo está habilitado
     *
     * @return bool
     */
    final public function isFeaturedProductEnabled(): bool
    {
        return $this->getConfig('featured_product_settings/featured_product_settings/enable_featured_product');
    }

    /**
     * Retorna o SKU do produto em destaque
     *
     * @return string
     */
    final public function getFeaturedProductSku(): string
    {
        return $this->getConfig('featured_product_settings/featured_product_settings/featured_product_sku');
    }

    /**
     * Retorna configurações do módulo com base nos parâmetros passados
     *
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
     * Obtem a imagem do produto ou imagem padrão caso não tenha imagem
     *
     * @param Product $product
     * @return string
     * @throws NoSuchEntityException
     */
    final public function getProductImage(Product $product) : string
    {
        $baseUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

            if ($product->getImage() && $product->getImage() !== 'no_selection') {
                $productImage = $baseUrl . 'catalog/product' . $product->getImage();
            } else {
                $productImage = $this->assetRepo->getUrl('Magento_Catalog::images/product/placeholder/image.jpg');
            }
        return $productImage;
    }
}
