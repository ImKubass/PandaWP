<?php

namespace Components\Page;

use KT_WP_Post_Base_Presenter;

class PagePresenter extends KT_WP_Post_Base_Presenter
{
    function __construct(PageModel $model)
    {
        parent::__construct($model);
    }

    // --- getry & setry ------------------------------

    /** @return PageModel */
    public function getModel()
    {
        return parent::getModel();
    }

    // --- veřejné metody ------------------------------
}