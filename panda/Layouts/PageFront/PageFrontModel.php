<?php

namespace Layouts\PageFront;

use Layouts\Page\PageModel;
use Utils\uString;
use Utils\Util;

class PageFrontModel extends PageModel
{

    public function __construct(\WP_Post $post)
    {
        parent::__construct($post, PageFrontConfig::FORM_PREFIX);
        $this->setMetaPrefix(PageFrontConfig::FORM_PREFIX);
    }

    //? --- Getry ------------------------------------------------------------


    //* --- Intro
    //* --- Prefix: Intro

    public function getIntroTitle()
    {
        return $this->getMetaValue(PageFrontConfig::INTRO_TITLE);
    }

    public function getIntroTitleFancy()
    {
        $fancyTitle = $this->getIntroTitle();
        $fancyTitle = uString::renderBreakTagInString($fancyTitle);
        $fancyTitle = uString::wrapWithSpan($fancyTitle);
        return $fancyTitle;
    }

    public function getIntroTitleClean()
    {
        return uString::cleanStringFromSpecialCharacters($this->getIntroTitle());
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
