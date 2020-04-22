<?php

namespace Presenters;

use Components\Post\Post;
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
    private $Component;
    private $Template;
    private $Args;

    private static $currentQueryLoopIndex;
    private static $currentQueryLoopCount;

    public function __construct($maxCount = self::DEFAULT_COUNT)
    {
        $this->maxCount = Util::tryGetInt($maxCount) ?: self::DEFAULT_COUNT;
        $this->setPostType(Post::KEY);
        $this->setComponent(Post::class);
        $this->setTemplate(Post::TEMPLATE);
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

    public function getComponent()
    {
        return $this->Component;
    }

    public function getArgs()
    {
        return $this->Args;
    }

    public function getTemplate()
    {
        return $this->Template;
    }


    //* --- Setters ------------------------------

    public function setMaxCount($maxCount)
    {
        return $this->maxCount = $maxCount;
    }

    public function setOffset($value)
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

    public function setComponent($Component)
    {
        return $this->Component = $Component;
    }

    public function setArgs($Args)
    {
        return $this->Args = $Args;
    }

    public function setTemplate($Template)
    {
        return $this->Template = $Template;
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

    public function isComponent()
    {
        return Util::issetAndNotEmpty($this->getComponent());
    }

    public function isTemplate()
    {
        return Util::issetAndNotEmpty($this->getTemplate());
    }



    // --- veřejné metody ------------------------------

    protected function tryGetUrlParamValue($requestKey)
    {
        $requestValue = Util::arrayTryGetValue($_REQUEST, $requestKey);
        if (Util::issetAndNotEmpty($requestValue)) {
            return $requestValue;
        }
        return null;
    }

    public function thePosts($Count = null, $Offset = null, $Template = null)
    {


        if (Util::issetAndNotEmpty($Template)) {
            $Template = $Template;
        } else {
            $Template = $this->getTemplate();
        }

        if ($this->hasPosts()) {
            $this->itemsLoop($this->getPosts(), $Template, $Count, $Offset);
        }
    }

    public function getPostsOutput()
    {
        if ($this->hasPosts()) {
            ob_start();
            $this->thePosts();
            $output = ob_get_clean();
            return $output;
        }
    }

    /**
     * Výpis postů podle zadané query v zadané loopě
     * 
     * @author Martin Hlaváč
     * 
     * @param \WP_Query $query
     * @param string $LoopName
     */
    public static function queryLoops(\WP_Query $query, $LoopName)
    {
        $componentPath = locate_template(COMPONENTS_PATH . "$LoopName/$LoopName.php");
        if (Util::issetAndNotEmpty($query) && $query->have_posts()) {
            self::$currentQueryLoopIndex = 0;
            self::$currentQueryLoopCount = count($query->get_posts());
            while ($query->have_posts()) : $query->the_post();
                global $post;
                include($componentPath);
                self::$currentQueryLoopIndex++;

            endwhile;
            self::$currentQueryLoopIndex = null;
            self::$currentQueryLoopCount = null;
            wp_reset_postdata();
        }
    }

    private function itemsLoop(array $items, $template, $count = null, $offset = null)
    {

        $componentName = dirname(str_replace("\\", "/", $this->getComponent()));

        $Path = locate_template("panda/$componentName/templates/$template.php");
        if (Util::arrayIssetAndNotEmpty($items) && file_exists($Path)) {

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
                include($Path);
                self::$Counter++;
            }
            wp_reset_postdata();
        }
    }

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

    private function initPosts()
    {

        $this->initArgs();
        $args = $this->getArgs();

        $query = new \WP_Query();
        $this->setQuery($query);
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
