<?php

namespace Components\PostsQuery;

use KT_Presenter_Base;
use KT_Repository;
use WP_Query;
use Utils\Util;

class PostsQuery extends KT_Presenter_Base
{
    const DEFAULT_COUNT = 3;

    private $posts;
    private $postsCount;
    private $maxCount;
    private $termId;
    private $taxonomy;
    private $query;

    public function __construct($maxCount = self::DEFAULT_COUNT, $withInitParams = true)
    {
        parent::__construct();
        $this->maxCount = Util::tryGetInt($maxCount) ?: self::DEFAULT_COUNT;
        if ($withInitParams) {
            $this->initParams();
        }
    }

    // --- getry & setry ------------------------------


    /** @return array */
    public function getPosts()
    {
        if (Util::issetAndNotEmpty($this->posts)) {
            return $this->posts;
        }
        $results = $this->initPosts();
        return $this->posts;
    }

    /** @return int */
    public function getPostsCount()
    {
        if (isset($this->postsCount)) {
            return $this->postsCount;
        }
        $results = $this->initPosts();
        return $this->postsCount;
    }

    /** @return int */
    public function getMaxCount()
    {
        return $this->maxCount;
    }

    /** @return int */
    public function getTermId()
    {
        return $this->termId;
    }

    /** @return int */
    public function getTaxonomy()
    {
        return $this->taxonomy;
    }

    /** @return int */
    public function getInitialOffset()
    {
        return $this->getOffset() ?: self::DEFAULT_COUNT;
    }

    private function setOffset($value)
    {
        $this->offset = Util::tryGetInt($value);
        return $this;
    }

    private function setTaxonomy($value)
    {
        $this->taxonomy = $value;
        return $this;
    }

    private function setTermId($value)
    {
        $this->termId = Util::tryGetInt($value);
        return $this;
    }

    // --- veřejné metody ------------------------------

    /** @return boolean */
    public function hasPosts()
    {
        return $this->getPostsCount() > 0;
    }

    public function thePosts()
    {
        if ($this->hasPosts()) {
            self::itemsLoop($this->getPosts(), POST_LOOP);
        }
    }

    public function thePostsTwig()
    {
        if ($this->hasPosts()) {
            self::itemsLoopTwig($this->getPosts(), POST_LOOP);
        }
    }


    public function itemsLoop(array $items, $componentName, $count = null, $offset = null)
    {
        $componentPath = locate_template(COMPONENTS_PATH . "$componentName/$componentName.php");
        if (Util::arrayIssetAndNotEmpty($items) && file_exists($componentPath)) {
            if (Util::tryGetInt($offset) > 0) {
                $items = array_slice($items, $offset);
            }
            if (Util::tryGetInt($count) > 0) {
                $items = array_slice($items, 0, $count);
            }
            foreach ($items as $item) {
                global $post;
                $post = $item;
                include($componentPath);
            }
            wp_reset_postdata();
        }
    }

    /** @return boolean */
    public function isOffset()
    {
        return Util::isIdFormat($this->getOffset());
    }

    /** @return boolean */
    public function isTermId()
    {
        return Util::isIdFormat($this->getTermId());
    }

    /** @return boolean */
    public function isQuery()
    {
        return Util::issetAndNotEmpty($this->getQuery());
    }

    // --- neveřejné metody ------------------------------

    private function initParams()
    {
        $this->setOffset(Util::arrayTryGetValue($_REQUEST, "kt_offset"));
        $queriedObject = get_queried_object();
        if (Util::issetAndNotEmpty($queriedObject)) {
            if (property_exists($queriedObject, "term_id")) {
                $this->setTermId($queriedObject->term_id);
                $this->setTaxonomy($queriedObject->taxonomy);
            }
        } else {
            $this->setTermId(Util::arrayTryGetValue($_REQUEST, "kt_term_id"));
            $this->setTaxonomy(Util::arrayTryGetValue($_REQUEST, "kt_taxonomy"));
        }
    }

    private function initPosts()
    {

        $args = [
            "post_type" => KT_WP_POST_KEY,
            "post_status" => "publish",
            "posts_per_page" => $this->getMaxCount(),
            "orderby" => "date",
            "order" => KT_Repository::ORDER_DESC,
        ];
        // except himself
        if (is_single()) {
            $args["post__not_in"] = [get_the_ID()];
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
        $query = new WP_Query();
        $posts = $query->query($args);
        if (Util::arrayIssetAndNotEmpty($posts)) {
            $this->posts = $posts;
            $this->postsCount = count($posts);
        } else {
            $this->posts = [];
            $this->postsCount = 0;
        }
    }
}
