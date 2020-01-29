<?php


namespace Components\Post\Term;

/**
 * Class CategoryModel
 * @package Components\Post\Term
 */
class CategoryModel extends \KT_WP_Term_Base_Model
{


    public function __construct(\WP_Term $term)
    {
        parent::__construct($term);
    }

    public function getTitle()
    {
        return $this->getName();
    }

    public function getContent()
    {
        return $this->getDescription();
    }
}
