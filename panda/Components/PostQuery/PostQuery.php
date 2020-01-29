<?php

namespace Components\PostQuery;

use Utils\Util;
use Presenters\QueryBase;

/**
 * Class PostQuery
 * @package Components\PostQuery
 */
class PostQuery extends QueryBase
{

    public function __construct()
    {
        parent::__construct();
        $this->initParams();
        $this->initArgs();
    }

    private function initParams()
    {
        $queriedObject = get_queried_object();
        if (Util::issetAndNotEmpty($queriedObject)) {
            if (property_exists($queriedObject, "term_id")) {
                $this->setTermId($queriedObject->term_id);
                $this->setTaxonomy($queriedObject->taxonomy);
            }
        }
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
        $Args["tax_query"] = $taxQuery;

        return $this->setArgs($Args);
    }
}
