<?php

namespace Components\ProductQuery;

class ProductQueryFactory
{
    /**
     * @return ProductQuery
     */
    public static function create()
    {
        return new ProductQuery();
    }
}
