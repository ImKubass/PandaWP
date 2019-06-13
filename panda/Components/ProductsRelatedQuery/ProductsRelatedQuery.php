<?php

namespace Components\ProductsRelatedQuery;

use Utils\Util;

class ProductsRelatedQuery extends \KT_Presenter_Base
{
    const DEFAULT_COUNT = 4;

    private $posts;
    private $postsCount;
    private $maxCount;

    private $BrandIds;

    public function __construct($maxCount = self::DEFAULT_COUNT)
    {
        parent::__construct();
        $this->maxCount = Util::tryGetInt($maxCount) ?: self::DEFAULT_COUNT;
        $this->initParams();
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

    /** @return array */
    public function getBrandIds()
    {
        return $this->BrandIds;
    }


    // --- Setters ------------------------------

    public function setBrandIds($BrandIds)
    {
        return $this->BrandIds = $BrandIds;
    }


    // --- Issets ------------------------------

    public function isBrandIds()
    {
        return Util::arrayIssetAndNotEmpty($this->getBrandIds());
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
            self::itemsLoop($this->getPosts(), PRODUCT_LOOP);
        }
    }

    public static function itemsLoop(array $items, $componentName, $count = null)
    {
        $componentPath = locate_template(COMPONENTS_PATH . "$componentName/$componentName.php");
        if (Util::arrayIssetAndNotEmpty($items) && file_exists($componentPath)) {
            if (Util::tryGetInt($count) > 0) {
                $items = array_slice($items, 0, $count);
            }
            $Counter = 1;
            foreach ($items as $item) {
                global $post;
                $post = $item;
                include($componentPath);
                $Counter++;
            }
            wp_reset_postdata();
            unset($Counter);
        }
    }

    public function initParams()
    {
        if (is_tax(PRODUCT_BRAND_KEY)) {
            $termBrand = get_queried_object();
            $this->setBrandIds([$termBrand->term_id]);
        }
    }



    // --- neveřejné metody ------------------------------


    private function initPosts()
    {

        $args = [
            "post_type" => PRODUCT_KEY,
            "post_status" => "publish",
            "posts_per_page" => $this->getMaxCount(),
            "orderby" => "menu_order date",
            "order" => \KT_Repository::ORDER_ASC,
            "tax_query" => [
                "relation" => "AND",
            ]
        ];

        if (is_single()) {
            $args["post__not_in"] = [get_the_ID()];
        }

        if ($this->isBrandIds()) {
            $brandsArgs = [
                "taxomy" => PRODUCT_BRAND_KEY,
                "field" => "term_taxonomy_id",
                "terms" => $this->getBrandIds()
            ];
            array_push($args["tax_query"], $brandsArgs);
        }

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
