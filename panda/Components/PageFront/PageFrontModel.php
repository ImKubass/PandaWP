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

    //* --- Naše produkty
    //* --- Prefix: BrandsSection

    public function getBrandsSectionTitle()
    {
        return $this->getMetaValue(PageFrontConfig::BRANDS_SECTION_TITLE);
    }

    public function getBrandsSectionTitleFancy()
    {
        return Util::wrapWithSpan($this->getBrandsSectionTitle());
    }

    /** @return array */
    public function getBrandsSectionBrandsIds()
    {
        return $this->getMetaValue(PageFrontConfig::BRANDS_SECTION_BRANDS_IDS);
    }


    //* --- Kudy k nám
    //* --- Prefix: WhereToFindUs

    public function getWhereToFindUsText()
    {
        return $this->getMetaValue(PageFrontConfig::WHERE_TO_FIND_US_TEXT);
    }

    public function getWhereToFindUsMapUrl()
    {
        return $this->getMetaValue(PageFrontConfig::WHERE_TO_FIND_US_MAP_URL);
    }

    //* --- Pokud už topíte
    //* --- Prefix: BottomSeoSection

    public function getBottomSeoSectionTitle()
    {
        return $this->getMetaValue(PageFrontConfig::BOTTOM_SEO_SECTION_TITLE);
    }

    public function getBottomSeoSectionTitleFancy()
    {
        $fancyTitle = $this->getBottomSeoSectionTitle();
        $fancyTitle = Util::renderBreakTagInString($fancyTitle);
        $fancyTitle = Util::wrapWithSpan($fancyTitle);
        return $fancyTitle;
    }

    public function getBottomSeoSectionDesctiption()
    {
        return $this->getMetaValue(PageFrontConfig::BOTTOM_SEO_SECTION_DESCRIPTION);
    }

    public function getBottomSeoSectionPostsIds()
    {
        return $this->getMetaValue(PageFrontConfig::BOTTOM_SEO_SECTION_POSTS_IDS);
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


    //* --- Naše produkty
    //* --- Prefix: BrandsSection

    public function isBrandsSectionTitle()
    {
        return Util::issetAndNotEmpty($this->getBrandsSectionTitle());
    }

    public function isBrandsSectionBrandsIds()
    {
        return Util::issetAndNotEmpty($this->getBrandsSectionBrandsIds());
    }

    //* --- Kudy k nám
    //* --- Prefix: WhereToFindUs

    public function isWhereToFindUsText()
    {
        return Util::issetAndNotEmpty($this->getWhereToFindUsText());
    }

    public function isWhereToFindUsMapUrl()
    {
        return Util::issetAndNotEmpty($this->getWhereToFindUsMapUrl());
    }

    //* --- Pokud už topíte
    //* --- Prefix: BottomSeoSection

    public function isBottomSeoSectionTitle()
    {
        return Util::issetAndNotEmpty($this->getBottomSeoSectionTitle());
    }

    public function isBottomSeoSectionDesctiption()
    {
        return Util::issetAndNotEmpty($this->getBottomSeoSectionDesctiption());
    }

    public function isBottomSeoSectionPostsIds()
    {
        return Util::issetAndNotEmpty($this->getBottomSeoSectionPostsIds());
    }
}
