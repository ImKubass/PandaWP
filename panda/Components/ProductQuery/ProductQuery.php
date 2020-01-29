<?php

namespace Components\ProductQuery;

use Components\Product\Product;
use Presenters\QueryBase;

/**
 * Class ProductQuery
 * @package Components\ProductQuery
 */
class ProductQuery extends QueryBase
{

    public function __construct()
    {
        parent::__construct();
        $this->setComponent(Product::class);
        $this->setPostType(Product::KEY);
        $this->setTemplate(Product::TEMPLATE);
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
