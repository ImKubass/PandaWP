<?php

namespace Components\Post;

use Utils\Util;

class PostModel extends \KT_WP_Post_Base_Model
{

    private $userModel;

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, PostConfig::FORM_PREFIX);
    }

    //* --- getry & setry ------------------------

    //? --- Nastavení stránky
    //? --- Prefix: Settings

    public function getSettingsContentCenter()
    {
        return $this->getMetaValue(PostConfig::SETTINGS_CONTENT_CENTER);
    }

    public function getSettingsGalleryNoGutter()
    {
        return $this->getMetaValue(PostConfig::SETTINGS_GALLERY_NO_GUTTER);
    }


    //* --- issety ------------------------

    public function isSettingsContentCenter()
    {
        return Util::issetAndNotEmpty($this->getSettingsContentCenter());
    }

    public function isSettingsGalleryNoGutter()
    {
        return Util::issetAndNotEmpty($this->getSettingsGalleryNoGutter());
    }
}