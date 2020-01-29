<?php

namespace Components\Post\Term;

class CategoryFactory
{


    public static function create(): CategoryModel
    {
        return new CategoryModel(get_queried_object());
    }
}
