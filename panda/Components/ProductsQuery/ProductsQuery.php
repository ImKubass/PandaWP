<?php

namespace Components\ProductsQuery;

use Utils\Util;

class ProductsQuery extends \KT_Presenter_Base
{
    const DEFAULT_COUNT = 9;

    private $posts;
    private $postsCount;
    private $maxCount;
    private $Offset;

    private $BrandIds;
    private $PerformanceIds;
    private $AirSupplyIds;
    private $HeatTransferIds;

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

    /** @return array */
    public function getPerformanceIds()
    {
        return $this->PerformanceIds;
    }

    /** @return array */
    public function getAirSupplyIds()
    {
        return $this->AirSupplyIds;
    }

    /** @return array */
    public function getHeatTransferIds()
    {
        return $this->HeatTransferIds;
    }

    /** @return int */
    public function getOffset()
    {
        return $this->Offset;
    }


    // --- Setters ------------------------------

    public function setBrandIds($BrandIds)
    {
        return $this->BrandIds = $BrandIds;
    }

    public function setPerformanceIds($PerformanceIds)
    {
        return $this->PerformanceIds = $PerformanceIds;
    }

    public function setAirSupplyIds($AirSupplyIds)
    {
        return $this->AirSupplyIds = $AirSupplyIds;
    }

    public function setHeatTransferIds($HeatTransferIds)
    {
        return $this->HeatTransferIds = $HeatTransferIds;
    }

    public function setOffset($Offset)
    {
        return $this->Offset = $Offset;
    }

    public function setMaxCount($maxCount)
    {
        return $this->maxCount = $maxCount;
    }


    // --- Issets ------------------------------

    public function isBrandIds()
    {
        return Util::arrayIssetAndNotEmpty($this->getBrandIds());
    }

    public function isPerformanceIds()
    {
        return Util::arrayIssetAndNotEmpty($this->getPerformanceIds());
    }

    public function isAirSupplyIds()
    {
        return Util::arrayIssetAndNotEmpty($this->getAirSupplyIds());
    }

    public function isHeatTransferIds()
    {
        return Util::arrayIssetAndNotEmpty($this->getHeatTransferIds());
    }

    public function isOffset()
    {
        return Util::issetAndNotEmpty($this->getOffset());
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
        $this->setBrandIds($this->tryGetUrlParamValue("ajax_brand"));
        $this->setPerformanceIds($this->tryGetUrlParamValue("ajax_performance"));
        $this->setAirSupplyIds($this->tryGetUrlParamValue("ajax_airSupply"));
        $this->setHeatTransferIds($this->tryGetUrlParamValue("ajax_heatTransfer"));
        $this->setOffset($this->tryGetUrlParamValue("ajax_offset"));

        if (is_tax(PRODUCT_BRAND_KEY)) {
            $termBrand = get_queried_object();
            $this->setBrandIds([$termBrand->term_id]);
        }
    }

    private function tryGetUrlParamValue($requestKey)
    {
        $requestValue = Util::arrayTryGetValue($_REQUEST, $requestKey);
        if (Util::issetAndNotEmpty($requestValue)) {
            return $requestValue;
        }
        return null;
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

        if ($this->isOffset()) {
            $args["offset"] = $this->getOffset();
        }

        if ($this->isBrandIds()) {

            $brandsArgs = [
                "taxomy" => PRODUCT_BRAND_KEY,
                "field" => "term_taxonomy_id",
                "terms" => $this->getBrandIds()
            ];


            array_push($args["tax_query"], $brandsArgs);
        }

        if ($this->isPerformanceIds()) {

            $performanceArgs = [
                "taxomy" => PRODUCT_PERFORMANCE_KEY,
                "field" => "term_taxonomy_id",
                "terms" => $this->getPerformanceIds()
            ];

            array_push($args["tax_query"], $performanceArgs);
        }

        if ($this->isHeatTransferIds()) {

            $heatTransferArgs = [
                "taxomy" => PRODUCT_HEAT_TRANSFER_KEY,
                "field" => "term_taxonomy_id",
                "terms" => $this->getHeatTransferIds()
            ];

            array_push($args["tax_query"], $heatTransferArgs);
        }

        if ($this->isAirSupplyIds()) {

            $airSupplyArgs = [
                "taxomy" => PRODUCT_AIR_SUPPLY_KEY,
                "field" => "term_taxonomy_id",
                "terms" => $this->getAirSupplyIds()
            ];

            array_push($args["tax_query"], $airSupplyArgs);
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
