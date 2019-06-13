<?php

namespace Components\ProductsQuery;

class ProductsQueryFactory
{
    /**
     * @return ProductsQuery
     */
    public static function create()
    {
        return new ProductsQuery();
    }
}
