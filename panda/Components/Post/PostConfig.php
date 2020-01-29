<?php

namespace Components\Post;

use Interfaces\Configable;

/**
 * Class PostConfig
 * @package Components\Post
 */
class PostConfig implements Configable
{
    const FORM_PREFIX = Post::KEY;

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            // self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function registerMetaboxes()
    {
        registerMetabox(self::class, Post::KEY);
    }


    // --- Nastavení stránky ---------------------------

    const SETTINGS_FIELDSET = self::FORM_PREFIX . "-settings";
    const SETTINGS_CONTENT_CENTER = self::SETTINGS_FIELDSET . "-content-center";
    const SETTINGS_GALLERY_NO_GUTTER = self::SETTINGS_FIELDSET . "-gallery-no-gutter";

    public static function getSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SETTINGS_FIELDSET, __("Nastavení stránky", ADMIN_DOMAIN));
        $fieldset->setPostPrefix(self::SETTINGS_FIELDSET);

        $fieldset->addSwitch(self::SETTINGS_CONTENT_CENTER, __("Text na střed:", ADMIN_DOMAIN));
        $fieldset->addSwitch(self::SETTINGS_GALLERY_NO_GUTTER, __("Galerie bez mezer:", ADMIN_DOMAIN));

        return $fieldset;
    }
}
