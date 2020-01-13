<?php

namespace Components\ProductsQuery;

use Presenters\QueryBase;

class ProductsQuery extends QueryBase
{

    public function __construct()
    {
        parent::__construct();
        $this->setPostType(PRODUCT_KEY);
        $this->setComponentLoopName("Item");
        $this->initArgs();
    }


    // Custom Args for Query
    public function initArgs()
    {
        $Args = [
            "post_type" => $this->getPostType(),
            "post_status" => "publish",
            "posts_per_page" => $this->getMaxCount(),
            "orderby" => "date",
            "order" => \KT_Repository::ORDER_DESC,
        ];

        return $this->setArgs($Args);
    }
}
