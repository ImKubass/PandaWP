<?php

namespace Presenters;

use Utils\Util;

class QueryBase
{
    const DEFAULT_COUNT = 10;
    private $posts;
    private $postsCount;
    private $maxCount;
    private $termId;
    private $taxonomy;
    private $query;
    private $Offset;
    private static $Counter;
    private $PostType;
    private $ComponentLoopName;

    public function __construct($maxCount = self::DEFAULT_COUNT)
    {
        $this->maxCount = Util::tryGetInt($maxCount) ?: self::DEFAULT_COUNT;
        $this->setPostType(POST_KEY);
        $this->setComponentLoopName(POST_LOOP);
    }


    //* --- Getters ------------------------------


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

    public function getCounter()
    {
        return self::$Counter;
    }

    /** @return int */
    public function getOffset()
    {
        return $this->Offset;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getPostType()
    {
        return $this->PostType;
    }

    public function getComponentLoopName()
    {
        return $this->ComponentLoopName;
    }


    //* --- Setters ------------------------------

    private function setOffset($value)
    {
        $this->Offset = Util::tryGetInt($value);
        return $this;
    }

    public function setTaxonomy($value)
    {
        $this->taxonomy = $value;
        return $this;
    }

    public function setTermId($value)
    {
        $this->termId = Util::tryGetInt($value);
        return $this;
    }

    public function setQuery(\WP_Query $query = null)
    {
        return $this->query = $query;
    }

    public function setPostType($PostType)
    {
        return $this->PostType = $PostType;
    }

    public function setComponentLoopName($ComponentLoopName)
    {
        return $this->ComponentLoopName = $ComponentLoopName;
    }


    //* --- Issets ------------------------------

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

    /** @return boolean */
    public function hasPosts()
    {
        return $this->getPostsCount() > 0;
    }

    public function isPostType()
    {
        return Util::issetAndNotEmpty($this->getPostType());
    }

    public function isComponentLoopName()
    {
        return Util::issetAndNotEmpty($this->getComponentLoopName());
    }



    // --- veřejné metody ------------------------------

    public function thePosts($Count = null, $Offset = null)
    {
        if ($this->hasPosts()) {
            self::itemsLoop($this->getPosts(), $this->getComponentLoopName(), $Count, $Offset);
        }
    }

    public static function itemsLoop(array $items, $componentName, $count = null, $offset = null)
    {
        $componentPath = locate_template(COMPONENTS_PATH . "$componentName/$componentName.php");
        if (Util::arrayIssetAndNotEmpty($items) && file_exists($componentPath)) {

            self::$Counter = 1;

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
                self::$Counter++;
            }
            wp_reset_postdata();
        }
    }

    private function initPosts()
    {

        $args = [
            "post_type" => $this->getPostType(),
            "post_status" => "publish",
            "posts_per_page" => $this->getMaxCount(),
            "orderby" => "date",
            "order" => \KT_Repository::ORDER_DESC,
        ];

        $query = new \WP_Query();
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
