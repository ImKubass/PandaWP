<?php

namespace Components\ProductsQuery;

use Presenters\QueryBase;

class ProductsQuery extends QueryBase
{

    public function __construct()
    {
        parent::__construct();
        $this->setPostType(PRODUCT_KEY);
    }
}
