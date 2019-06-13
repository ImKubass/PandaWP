<?php

namespace Components\Post;

use Utils\Util;

class PostPresenter extends \KT_WP_Post_Base_Presenter
{

    function __construct(PostModel $model)
    {
        parent::__construct($model);
    }

    // --- getry & setry ------------------------------

    /** @return PostModel */
    public function getModel()
    {
        return parent::getModel();
    }

    // --- veřejné metody ------------------------------

    public function title()
    {
        return $this->getModel()->getTitle();
    }

    public function permaLink()
    {
        return $this->getModel()->getPermalink();
    }

    public function excerpt()
    {
        return $this->getModel()->getExcerpt(true, 15);
    }
}
