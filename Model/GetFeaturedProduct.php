<?php

namespace MagentoModules\FeaturedProduct\Model;

use Exception;
use MagentoModules\FeaturedProduct\Api\GetFeaturedProductInterface;
use MagentoModules\FeaturedProduct\Model\Resolver\FeaturedProductResolver;

class GetFeaturedProduct implements GetFeaturedProductInterface
{

    /**
     * @param FeaturedProductResolver $featuredProductModel
     */
    public function __construct(
        private readonly FeaturedProductResolver $featuredProductModel
    )
    {

    }

    /**
     * Retorna o array com os dados do produto em destaque
     *
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
