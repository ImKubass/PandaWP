<?php

namespace Components\EmployeesQuery;

use Utils\Util;

class EmployeesQuery extends \KT_Presenter_Base
{
    const DEFAULT_COUNT = -1;

    private $posts;
    private $postsCount;
    private $maxCount;

    public function __construct($maxCount = self::DEFAULT_COUNT)
    {
        parent::__construct();
        $this->maxCount = Util::tryGetInt($maxCount) ?: self::DEFAULT_COUNT;
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


    // --- veřejné metody ------------------------------

    /** @return boolean */
    public function hasPosts()
    {
        return $this->getPostsCount() > 0;
    }

    public function thePosts()
    {
        if ($this->hasPosts()) {
            self::itemsLoop($this->getPosts(), EMPLOYEE_LOOP);
        }
    }

    public function itemsLoop(array $items, $componentName)
    {
        $componentPath = locate_template(COMPONENTS_PATH . "$componentName/$componentName.php");
        if (Util::arrayIssetAndNotEmpty($items) && file_exists($componentPath)) {
            foreach ($items as $item) {
                global $post;
                $post = $item;
                include($componentPath);
            }
            wp_reset_postdata();
        }
    }


    // --- neveřejné metody ------------------------------


    private function initPosts()
    {
        $args = [
            "post_type" => EMPLOYEE_KEY,
            "post_status" => "publish",
            "posts_per_page" => $this->getMaxCount(),
            "orderby" => "menu_order date",
            "order" => \KT_Repository::ORDER_ASC,
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
