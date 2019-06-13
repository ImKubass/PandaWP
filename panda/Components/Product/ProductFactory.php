<?php

namespace Components\Product;

class ProductFactory
{
    /**
     * @return ProductPresenter
     */
    public static function create()
    {
        global $post;
        return new ProductPresenter(new ProductModel($post));
    }
}