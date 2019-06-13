<?php

namespace Components\FooterHeaderSettings;

class FooterHeaderSettingsConfig implements \KT_Configable
{
    const FORM_PREFIX = "footer-header-settings";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::FOOTER_FIRST_COL_FIELDSET => self::getFooterFirstColFieldset(),
            self::FOOTER_SECOND_COL_FIELDSET => self::getFooterSecondColFieldset(),
            self::FOOTER_THIRD_COL_FIELDSET => self::getFooterThirdColFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    // --- Patička 1.Sloupec------------------------

    const FOOTER_FIRST_COL_FIELDSET = self::FORM_PREFIX . "-footer-first-col";
    const FOOTER_FIRST_COL_TITLE = self::FOOTER_FIRST_COL_FIELDSET . "-title";
    const FOOTER_FIRST_COL_EDITOR = self::FOOTER_FIRST_COL_FIELDSET . "-editor";

    public static function getFooterFirstColFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FOOTER_FIRST_COL_FIELDSET, __("Patička 1.Sloupec", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::FOOTER_FIRST_COL_FIELDSET);

        $fieldset->addText(self::FOOTER_FIRST_COL_TITLE, __("Titulek:", "RLG_DOMAIN"))
            ->setDefaultValue(__("Kontaktní údaje", "RLG_DOMAIN"));


        return $fieldset;
    }

    // --- Patička 2.Sloupec------------------------

    const FOOTER_SECOND_COL_FIELDSET = self::FORM_PREFIX . "-second-col";
    const FOOTER_SECOND_COL_TITLE = self::FOOTER_SECOND_COL_FIELDSET . "-title";
    const FOOTER_SECOND_COL_EDITOR = self::FOOTER_SECOND_COL_FIELDSET . "-editor";

    public static function getFooterSecondColFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FOOTER_SECOND_COL_FIELDSET, __("Patička 2.Sloupec", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::FOOTER_SECOND_COL_FIELDSET);

        $fieldset->addText(self::FOOTER_SECOND_COL_TITLE, __("Titulek:", "RLG_DOMAIN"))
            ->setDefaultValue(__("Fakturační údaje", "RLG_DOMAIN"));

        return $fieldset;
    }

    // --- Patička 3.Sloupec------------------------

    const FOOTER_THIRD_COL_FIELDSET = self::FORM_PREFIX . "-third-col";
    const FOOTER_THIRD_COL_TITLE = self::FOOTER_THIRD_COL_FIELDSET .  "-title";

    public static function getFooterThirdColFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FOOTER_THIRD_COL_FIELDSET, __("Patička 3.Sloupec", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::FOOTER_THIRD_COL_FIELDSET);

        $fieldset->addText(self::FOOTER_THIRD_COL_TITLE, __("Titulek:", "RLG_DOMAIN"))
            ->setDefaultValue(__("Důležité informace", "RLG_DOMAIN"));

        return $fieldset;
    }
}