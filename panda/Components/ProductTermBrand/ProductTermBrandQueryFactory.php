<?php

namespace Components\ProductTermBrand;

use Components\ProductTerm\ProductTermQuery;

class ProductTermBrandQueryFactory
{
    /** @return ProductTermQuery */
    public static function create()
    {
        return new ProductTermQuery(PRODUCT_BRAND_KEY, PRODUCT_BRAND_LOOP);
    }
}