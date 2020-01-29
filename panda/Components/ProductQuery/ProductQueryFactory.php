<?php

namespace Components\ProductQuery;

/**
 * Class ProductQueryFactory
 * @package Components\ProductQuery
 */
class ProductQueryFactory
{

    public static function create(): ProductQuery
    {
        return new ProductQuery();
    }
}
