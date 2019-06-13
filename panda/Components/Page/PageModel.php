<?php

namespace Components\Page;

use Components\Page\PageConfig;
use Utils\Util;

class PageModel extends \KT_WP_Post_Base_Model
{
    function __construct(\WP_Post $post)
    {
        parent::__construct($post, PageConfig::FORM_PREFIX);
    }

    //* --- getry ------------------------

    public function getThumbnailSrc()
    {
        return Util::getImageSrc($this->getThumbnailId(), IMAGE_SIZE_420x300);
    }

    public function getThumbnailSrc2x()
    {
        return Util::getImageSrc($this->getThumbnailId(), IMAGE_SIZE_840x600);
    }

    //? --- Nastavení stránky
    //? --- Prefix: Settings

    public function getSettingsButtonText()
    {
        return $this->getMetaValue(PageConfig::SETTINGS_BUTTON_TEXT);
    }

    //* --- issety ------------------------


    //? --- Nastavení stránky
    //? --- Prefix: Settings

    public function isSettingsButtonText()
    {
        return Util::issetAndNotEmpty($this->getSettingsButtonText());
    }


    //* --- Setters ------------------------ 


}
