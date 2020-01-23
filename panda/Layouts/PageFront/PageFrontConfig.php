<?php

namespace Layouts\PageFront;

use Interfaces\Configable;

class PageFrontConfig implements Configable
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
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function registerMetaboxes()
    {
        $pageFrontMetaboxes = \KT_MetaBox::createMultiple(self::getAllNormalFieldsets(), KT_WP_PAGE_KEY, \KT_MetaBox_Data_Type_Enum::POST_META, false);
        foreach ($pageFrontMetaboxes as $pageFrontMetabox) {
            $pageFrontMetabox->setIsOnlyForFrontPage(true);
            $pageFrontMetabox->register();
        }
    }

    // --- Intro ------------------------

    const INTRO_FIELDSET = self::FORM_PREFIX . "-intro";
    const INTRO_TITLE = self::INTRO_FIELDSET . "-title";
    const INTRO_DESCRIPTION = self::INTRO_FIELDSET . "-description";
    const INTRO_PAGE_ID = self::INTRO_FIELDSET . "-page-id";


    public static function getIntroFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::INTRO_FIELDSET, __("Intro", DOMAIN));
        $fieldset->setPostPrefix(self::INTRO_FIELDSET);

        $fieldset->addText(self::INTRO_TITLE, __("Titulek:", DOMAIN));
        $fieldset->addText(self::INTRO_DESCRIPTION, __("Popisek", DOMAIN));
        $fieldset->addWpPage(self::INTRO_PAGE_ID, __("Naše služby:", DOMAIN))
            ->setFirstEmpty();


        return $fieldset;
    }
}

PageFrontConfig::registerMetaboxes();
