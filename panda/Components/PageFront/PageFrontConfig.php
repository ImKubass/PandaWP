<?php

namespace Components\PageFront;


class PageFrontConfig implements \KT_Configable
{

    const FORM_PREFIX = "page-front";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::INTRO_FIELDSET => self::getIntroFieldset(),
            self::BRANDS_SECTION_FIELDSET => self::getBrandsSectionFieldset(),
            self::WHERE_TO_FIND_US_FIELDSET => self::getWhereToFindUsFieldset(),
            self::BOTTOM_SEO_SECTION_FIELDSET => self::getBottomSeoSectionFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    // --- Intro ------------------------

    const INTRO_FIELDSET = self::FORM_PREFIX . "-intro";
    const INTRO_TITLE = self::INTRO_FIELDSET . "-title";
    const INTRO_DESCRIPTION = self::INTRO_FIELDSET . "-description";
    const INTRO_PAGE_ID = self::INTRO_FIELDSET . "-page-id";


    public static function getIntroFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::INTRO_FIELDSET, __("Intro", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::INTRO_FIELDSET);

        $fieldset->addText(self::INTRO_TITLE, __("Titulek:", "RLG_DOMAIN"));
        $fieldset->addText(self::INTRO_DESCRIPTION, __("Popisek", "RLG_DOMAIN"));
        $fieldset->addWpPage(self::INTRO_PAGE_ID, __("Naše služby:", "RLG_DOMAIN"))
            ->setFirstEmpty();


        return $fieldset;
    }

    // --- Naše produkty ------------------------

    const BRANDS_SECTION_FIELDSET = self::FORM_PREFIX . "-brands-section";
    const BRANDS_SECTION_TITLE = self::BRANDS_SECTION_FIELDSET . "-title";
    const BRANDS_SECTION_BRANDS_IDS = self::BRANDS_SECTION_FIELDSET . "-brands-ids";


    public static function getBrandsSectionFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::BRANDS_SECTION_FIELDSET, __("Naše produkty", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::BRANDS_SECTION_FIELDSET);

        $ProductsBrands = new \KT_Taxonomy_Data_Manager(PRODUCT_BRAND_KEY);

        $fieldset->addText(self::BRANDS_SECTION_TITLE, __("Titulek:", "RLG_DOMAIN"));
        $fieldset->addMultiSelect(self::BRANDS_SECTION_BRANDS_IDS, __("Naše služby:", "RLG_DOMAIN"))
            ->setDataManager($ProductsBrands)
            ->setFirstEmpty();


        return $fieldset;
    }

    // --- Kde nás najdete ------------------------

    const WHERE_TO_FIND_US_FIELDSET = self::FORM_PREFIX . "-where-to-find-us";
    const WHERE_TO_FIND_US_TEXT = self::WHERE_TO_FIND_US_FIELDSET . "-text";
    const WHERE_TO_FIND_US_MAP_URL = self::WHERE_TO_FIND_US_FIELDSET . "-map-url";


    public static function getWhereToFindUsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::WHERE_TO_FIND_US_FIELDSET, __("Kde nás najdete", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::WHERE_TO_FIND_US_FIELDSET);


        $fieldset->addText(self::WHERE_TO_FIND_US_TEXT, __("Text:", "RLG_DOMAIN"));
        $fieldset->addText(self::WHERE_TO_FIND_US_MAP_URL, __("Url mapy:", "RLG_DOMAIN"));


        return $fieldset;
    }

    // --- Pokud už topíte ------------------------

    const BOTTOM_SEO_SECTION_FIELDSET = self::FORM_PREFIX . "-bottom-seo-section";
    const BOTTOM_SEO_SECTION_TITLE = self::BOTTOM_SEO_SECTION_FIELDSET . "-title";
    const BOTTOM_SEO_SECTION_DESCRIPTION = self::BOTTOM_SEO_SECTION_FIELDSET . "-description";
    const BOTTOM_SEO_SECTION_POSTS_IDS = self::BOTTOM_SEO_SECTION_FIELDSET . "-posts-ids";


    public static function getBottomSeoSectionFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::BOTTOM_SEO_SECTION_FIELDSET, __("Pokud už topíte", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::BOTTOM_SEO_SECTION_FIELDSET);


        $fieldset->addText(self::BOTTOM_SEO_SECTION_TITLE, __("Titulek:", "RLG_DOMAIN"));
        $fieldset->addText(self::BOTTOM_SEO_SECTION_DESCRIPTION, __("Popisek:", "RLG_DOMAIN"));

        $PostsList = new \KT_Custom_Post_Data_Manager([
            "post_type" => KT_WP_POST_KEY,
            "post_status" => "publish",
            "posts_per_page" => -1,
            "orderby" => "title",
            "order" => \KT_Repository::ORDER_ASC,
        ]);

        $fieldset->addMultiSelect(self::BOTTOM_SEO_SECTION_POSTS_IDS, __("Články:", "RLG_DOMAIN"))
            ->setDataManager($PostsList)
            ->setFirstEmpty();


        return $fieldset;
    }
}