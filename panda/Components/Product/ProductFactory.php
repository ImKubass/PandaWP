<?php

namespace Components\Product;

/**
 * Class ProductFactory
 * @package Components\Product
 */
class ProductFactory
{
    public static function create(): ProductModel
    {
        global $post;
        return new ProductModel($post);
    }
}
