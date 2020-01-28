<?php

namespace Components\Post\Term;

use Interfaces\Configable;

class CategoryConfig implements Configable
{

    const FORM_PREFIX = Category::PREFIX;

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

    public static function registerMetaboxes()
    {
        \KT_Term_MetaBox::createMultiple(self::getAllGenericFieldsets(), Category::KEY);
    }

    // --- Nastavení stránky ---------------------------

    const SETTINGS_FIELDSET = self::FORM_PREFIX . "-settings";
    const SETTINGS_SECRET = self::SETTINGS_FIELDSET . "-secret";
    const SETTINGS_THUMBNAIL = self::SETTINGS_FIELDSET . "-thumbnail";
    const SETTINGS_MANAGEMENT = self::SETTINGS_FIELDSET . "-management";


    public static function getSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SETTINGS_FIELDSET, __("Nastavení stránky", "ADMIN_ZKL_DOMAIN"));
        $fieldset->setPostPrefix(self::SETTINGS_FIELDSET);

        $fieldset->addSwitch(self::SETTINGS_SECRET, __("Tajné:", "ADMIN_ZKL_DOMAIN"));
        $fieldset->addMedia(self::SETTINGS_THUMBNAIL, __("Náhledový obrázek:", "ADMIN_ZKL_DOMAIN"));
        $fieldset->addSwitch(self::SETTINGS_MANAGEMENT, __("Management:", "ADMIN_ZKL_DOMAIN"));

        return $fieldset;
    }
}
