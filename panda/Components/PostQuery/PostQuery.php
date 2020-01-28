<?php

namespace Components\PostQuery;

use Presenters\QueryBase;

class PostQuery extends QueryBase
{

    public function __construct()
    {
        parent::__construct();
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

        // except himself
        if (is_single()) {
            $Args["post__not_in"] = [get_the_ID()];
        }

        // category
        $taxQuery = ["relation" => "AND"];
        if ($this->isTermId()) {
            array_push($taxQuery, [
                "taxonomy" => $this->getTaxonomy(),
                "field" => "term_id",
                "terms" => [$this->getTermId()],
            ]);
        }
        $args["tax_query"] = $taxQuery;

        return $this->setArgs($Args);
    }
}
