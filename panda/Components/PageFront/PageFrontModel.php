<?php

namespace Components\PageFront;

use Components\Page\PageModel;
use Utils\Util;

class PageFrontModel extends PageModel
{

    public function __construct(\WP_Post $post)
    {
        parent::__construct($post, PageFrontConfig::FORM_PREFIX);
        $this->setMetaPrefix(PageFrontConfig::FORM_PREFIX);
    }

    //? --- Getry ------------------------------------------------------------

    public function getThumbnailSrc()
    {
        return Util::getImageSrc($this->getThumbnailId(), IMAGE_SIZE_580x385);
    }

    public function getThumbnailSrc2x()
    {
        return Util::getImageSrc($this->getThumbnailId(), IMAGE_SIZE_1160x770);
    }

    //* --- Intro
    //* --- Prefix: Intro

    public function getIntroTitle()
    {
        return $this->getMetaValue(PageFrontConfig::INTRO_TITLE);
    }

    public function getIntroTitleFancy()
    {
        $fancyTitle = $this->getIntroTitle();
        $fancyTitle = Util::renderBreakTagInString($fancyTitle);
        $fancyTitle = Util::wrapWithSpan($fancyTitle);
        return $fancyTitle;
    }

    public function getIntroTitleClean()
    {
        return Util::cleanStringFromSpecialCharacters($this->getIntroTitle());
    }

    public function getIntroDescription()
    {
        return $this->getMetaValue(PageFrontConfig::INTRO_DESCRIPTION);
    }

    public function getIntroPageId()
    {
        return $this->getMetaValue(PageFrontConfig::INTRO_PAGE_ID);
    }

    public function getIntroPageLink()
    {
        return $url = get_permalink($this->getIntroPageId());
    }



    //? --- Issety ------------------------------------------------------------------------

    //* --- Intro
    //* --- Prefix: Intro

    public function isIntroTitle()
    {
        return Util::issetAndNotEmpty($this->getIntroTitle());
    }

    public function isIntroDescription()
    {
        return Util::issetAndNotEmpty($this->getIntroDescription());
    }

    public function isIntroPageId()
    {
        return Util::issetAndNotEmpty($this->getIntroPageId());
    }
}
