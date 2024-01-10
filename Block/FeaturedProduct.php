<?php
namespace MagentoModules\FeaturedProduct\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use MagentoModules\FeaturedProduct\Model\FeaturedProduct as FeaturedProductModel;
use MagentoModules\FeaturedProduct\Helper\Data;

class FeaturedProduct extends Template
{
    private FeaturedProductModel $featuredProductModel;

    private Data $helperData;

    /**
     * @param Context $context
     * @param FeaturedProductModel $featuredProductModel
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        FeaturedProductModel $featuredProductModel,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helperData = $helper;
        $this->featuredProductModel = $featuredProductModel;
    }

    final public function isFeaturedProductEnabled(): bool
    {
        return $this->helperData->isFeaturedProductEnabled();
    }

    /**
     * @return mixed
     */
    final public function getFeaturedProduct(): mixed
    {
        return $this->featuredProductModel->getFeaturedProduct();
    }

}
