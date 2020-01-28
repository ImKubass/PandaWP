<?php

namespace Components\PostQuery;

use Presenters\QueryBase;

class PostRelatedQuery extends QueryBase
{

    public function __construct()
    {
        parent::__construct();
        $this->initArgs();
    }

    // Custom Args for Query
    public function initArgs()
    {
        // Related by category
        $taxomyType = KT_WP_CATEGORY_KEY;
        $category = get_the_category();
        $taxomyRelated = $category[0]->cat_ID;


        $Args = [
            "post_type" => $this->getPostType(),
            "post_status" => "publish",
            "posts_per_page" => $this->getMaxCount(),
            "orderby" => "rand",
            "order" => \KT_Repository::ORDER_DESC,
            "tax_query" => [
                [
                    "taxonomy" => $taxomyType,
                    "fields" => "slug",
                    "terms" => $taxomyRelated
                ]
            ]
        ];
        // except himself
        if (is_single()) {
            $args["post__not_in"] = [get_the_ID()];
        }

        return $this->setArgs($Args);
    }
}
