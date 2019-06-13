<?php

namespace Components\ProductsRelatedQuery;

class ProductsRelatedQueryFactory
{
    /**
     * @return ProductsRelatedQuery
     */
    public static function create()
    {
        return new ProductsRelatedQuery();
    }
}
