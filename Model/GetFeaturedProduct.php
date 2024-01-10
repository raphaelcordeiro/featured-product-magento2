<?php

namespace MagentoModules\FeaturedProduct\Model;

use Exception;
use MagentoModules\FeaturedProduct\Api\GetFeaturedProductInterface;
use MagentoModules\FeaturedProduct\Model\Resolver\FeaturedProductResolver;

class GetFeaturedProduct implements GetFeaturedProductInterface
{

    public function __construct(
        private readonly FeaturedProductResolver $featuredProductModel
    )
    {

    }

    /**
     * @return array
     */
    final public function execute() : array
    {
        try {
            return $this->featuredProductModel->resolver() ;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

}
