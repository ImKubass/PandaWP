<?php

namespace Components\Page;


class PageConfig implements \KT_Configable
{
    const FORM_PREFIX = "panda-page";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    // --- Nastavení stránky ---------------------------

    const SETTINGS_FIELDSET = self::FORM_PREFIX . "-settings";
    const SETTINGS_BUTTON_TEXT = self::SETTINGS_FIELDSET . "-button-text";


    public static function getSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SETTINGS_FIELDSET, __("Nastavení stránky", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::SETTINGS_FIELDSET);

        $fieldset->addText(self::SETTINGS_BUTTON_TEXT, __("Text tlačítka:", "RLG_DOMAIN"));

        return $fieldset;
    }
}