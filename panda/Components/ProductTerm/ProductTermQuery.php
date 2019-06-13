<?php

namespace Components\ProductTerm;

use Utils\Util;

class ProductTermQuery
{
    private $Categories;
    private $CategoriesCount;

    private $TermName;
    private $ComponentName;
    private $ComponentNamePostfix;

    private $CategoriesIds;

    /**
     * @param string $TermName
     * @param string $ComponentName 
     * @param string $ComponentNamePostfix
     */
    public function __construct($TermName, $ComponentName, $ComponentNamePostfix = null)
    {
        $this->TermName = $TermName;
        $this->ComponentName = $ComponentName;
        $this->ComponentNamePostfix = $ComponentNamePostfix;
    }


    // --- getters ------------------------------

    /** @return array */
    public function getCategories()
    {
        if (Util::issetAndNotEmpty($this->Categories)) {
            return $this->Categories;
        }
        $results = $this->initCategories();
        return $this->Categories;
    }

    /** @return int */
    public function getCategoriesCount()
    {
        if (isset($this->CategoriesCount)) {
            return $this->CategoriesCount;
        }
        $results = $this->initCategories();
        return $this->CategoriesCount;
    }

    public function getTermName()
    {
        return $this->TermName;
    }

    public function getComponentName()
    {
        return $this->ComponentName;
    }

    public function getComponentNamePostfix()
    {
        return $this->ComponentNamePostfix;
    }


    public function getCategoriesIds()
    {
        return $this->CategoriesIds;
    }

    // --- setters -------------------------------

    /**
     * @param array $CategoriesIds
     * @return self
     * */
    public function setCategoriesIds(array $CategoriesIds)
    {
        return $this->CategoriesIds = $CategoriesIds;
    }

    // --- Issets -------------------------------

    /** @return bool */
    public function isCategoriesIds()
    {
        return Util::arrayIssetAndNotEmpty($this->getCategoriesIds());
    }


    // --- veřejné metody ------------------------------

    /** @return boolean */
    public function hasCategories()
    {
        return $this->getCategoriesCount() > 0;
    }

    public function theCategories()
    {
        if ($this->hasCategories()) {
            self::itemsLoop($this->getCategories(), $this->getComponentName());
        }
    }

    public static function itemsLoop(array $items, $componentName, $postfix = null)
    {
        $componentPath = locate_template(COMPONENTS_PATH . "$componentName/$componentName.php");
        if (!$postfix == null) {
            $componentPath = locate_template(COMPONENTS_PATH . "$componentName/$componentName" . "$postfix.php");
        }

        if (Util::arrayIssetAndNotEmpty($items) && file_exists($componentPath)) {
            $Counter = 1;
            global $term;
            foreach ($items as $item) {
                $term = $item;
                include($componentPath);
                $Counter++;
            }
            unset($term);
            unset($Counter);
        }
    }


    // --- neveřejné metody ------------------------------


    private function initCategories()
    {
        $args = [
            "taxonomy" => $this->getTermName(),
            "hide_empty" => 0,
        ];
        if ($this->isCategoriesIds()) {
            $args["include"] = $this->getCategoriesIds();
        }
        $Categories = get_categories($args);
        if (Util::arrayIssetAndNotEmpty($Categories)) {
            $this->Categories = $Categories;
            $this->CategoriesCount = count($Categories);
        } else {
            $this->Categories = [];
            $this->CategoriesCount = 0;
        }
    }
}