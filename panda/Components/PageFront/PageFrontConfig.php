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
}
