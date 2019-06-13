<?php

namespace Components\PageContact;


class PageContactConfig implements \KT_Configable
{

    const FORM_PREFIX = "page-contact";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::EMPLOYEES_SECTION_FIELDSET => self::getEmployeesSectionFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    // --- Sekce Zaměstnanci ------------------------

    const EMPLOYEES_SECTION_FIELDSET = self::FORM_PREFIX . "-intro";
    const EMPLOYEES_SECTION_TITLE = self::EMPLOYEES_SECTION_FIELDSET . "-title";
    const EMPLOYEES_SECTION_DESCRIPTION = self::EMPLOYEES_SECTION_FIELDSET . "-description";



    public static function getEmployeesSectionFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::EMPLOYEES_SECTION_FIELDSET, __("Sekce Zaměstnanci", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::EMPLOYEES_SECTION_FIELDSET);

        $fieldset->addText(self::EMPLOYEES_SECTION_TITLE, __("Titulek:", "RLG_DOMAIN"));
        $fieldset->addText(self::EMPLOYEES_SECTION_DESCRIPTION, __("Popisek", "RLG_DOMAIN"));

        return $fieldset;
    }
}
