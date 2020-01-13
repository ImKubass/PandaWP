<?php

namespace Components\Product;

class ProductFactory
{
    /**
     * @return ProductModel
     */
    public static function create()
    {
        global $post;
        return new ProductModel($post);
    }
}
