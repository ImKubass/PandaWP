<?php

namespace Components\ThemeSettings;

use Interfaces\Configable;


/**
 * Class ThemeSettingsConfig
 * @package Components\ThemeSettings
 */
class ThemeSettingsConfig implements Configable
{
    const FORM_PREFIX = "theme-settings";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::SOCIAL_FIELDSET => self::getSocialFieldset(),
            self::CONTACT_FIELDSET => self::getContactFieldset(),
            self::OPENING_HOURS_FIELDSET => self::getOpeningHoursFieldset(),
            self::ANALYTICS_FIELDSET => self::getAnalyticsFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function registerMetaboxes()
    {
        \KT_MetaBox::createMultiple(self::getAllNormalFieldsets(), \KT_WP_Configurator::getThemeSettingSlug(), \KT_MetaBox_Data_Type_Enum::OPTIONS);

        $themeSideMetaboxes = \KT_MetaBox::createMultiple(self::getAllSideFieldsets(), \KT_WP_Configurator::getThemeSettingSlug(), \KT_MetaBox_Data_Type_Enum::OPTIONS, false);
        foreach ($themeSideMetaboxes as $themeSideMetabox) {
            $themeSideMetabox->setContext(\KT_MetaBox::CONTEXT_SIDE);
            $themeSideMetabox->register();
        }
    }

    // --- SOCIÁLNÍ SÍTĚ ------------------------

    const SOCIAL_FIELDSET  = self::FORM_PREFIX . "-social";
    const SOCIAL_FACEBOOK  = self::SOCIAL_FIELDSET . "-facebook";
    const SOCIAL_INSTAGRAM = self::SOCIAL_FIELDSET . "-instagram";
    const SOCIAL_YOUTUBE   = self::SOCIAL_FIELDSET . "-youtube";


    public static function getSocialFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SOCIAL_FIELDSET, __("Sociální sítě", ADMIN_DOMAIN));
        $fieldset->setPostPrefix(self::SOCIAL_FIELDSET);

        $fieldset->addText(self::SOCIAL_FACEBOOK, __("Facebook:", ADMIN_DOMAIN))
            ->setInputType(\KT_Text_Field::INPUT_URL);
        $fieldset->addText(self::SOCIAL_INSTAGRAM, __("Instagram:", ADMIN_DOMAIN))
            ->setInputType(\KT_Text_Field::INPUT_URL);
        $fieldset->addText(self::SOCIAL_YOUTUBE, __("YouTube:", ADMIN_DOMAIN))
            ->setInputType(\KT_Text_Field::INPUT_URL);

        return $fieldset;
    }


    // --- KONTAKTY ------------------------

    const CONTACT_FIELDSET      = self::FORM_PREFIX . "-contact";
    const CONTACT_COMPANY_NAME  = self::CONTACT_FIELDSET . "-name";
    const CONTACT_STREET        = self::CONTACT_FIELDSET . "-street";
    const CONTACT_CITY          = self::CONTACT_FIELDSET . "-city";
    const CONTACT_ZIP           = self::CONTACT_FIELDSET . "-zip";
    const CONTACT_PHONE         = self::CONTACT_FIELDSET . "-contact-phone";
    const CONTACT_EMAIL         = self::CONTACT_FIELDSET . "-contact-email";
    const CONTACT_DESCRIPTION   = self::CONTACT_FIELDSET . "-description";
    const CONTACT_DIC           = self::CONTACT_FIELDSET . "-dic";
    const CONTACT_ICO           = self::CONTACT_FIELDSET . "-ico";
    const CONTACT_ESTABLISHMENT = self::CONTACT_FIELDSET . "-establishment";
    const CONTACT_LOGO_ID       = self::CONTACT_FIELDSET . "-logo-id";

    public static function getContactFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::CONTACT_FIELDSET, __("Kontaktní údaje pro vyhledávače", ADMIN_DOMAIN));
        $fieldset->setPostPrefix(self::CONTACT_FIELDSET);

        $fieldset->addText(self::CONTACT_COMPANY_NAME, __("Název Firmy:", ADMIN_DOMAIN));
        $fieldset->addText(self::CONTACT_STREET, __("Ulice a ČP:", ADMIN_DOMAIN));
        $fieldset->addText(self::CONTACT_CITY, __("Město:", ADMIN_DOMAIN));
        $fieldset->addText(self::CONTACT_ZIP, __("PSČ:", ADMIN_DOMAIN));
        $fieldset->addText(self::CONTACT_PHONE, __("Telefon:", ADMIN_DOMAIN));
        $fieldset->addText(self::CONTACT_EMAIL, __("E-mail:", ADMIN_DOMAIN))
            ->setInputType(\KT_Text_Field::INPUT_EMAIL)
            ->addRule(\KT_Field_Validator::EMAIL, __("E-mail musí být ve správném tvaru", ADMIN_DOMAIN));
        $fieldset->addDate(self::CONTACT_ESTABLISHMENT, __("Datum založení:", ADMIN_DOMAIN));
        $fieldset->addText(self::CONTACT_DESCRIPTION, __("Popisek:", ADMIN_DOMAIN));
        $fieldset->addText(self::CONTACT_DIC, __("DIČ:", ADMIN_DOMAIN));
        $fieldset->addText(self::CONTACT_ICO, __("IČO:", ADMIN_DOMAIN));
        $fieldset->addMedia(self::CONTACT_LOGO_ID, __("Logo:", ADMIN_DOMAIN));


        return $fieldset;
    }

    // --- Otevírací doba ------------------------

    const OPENING_HOURS_FIELDSET  = self::FORM_PREFIX . "-opening-hours";
    const OPENING_HOURS_MON_FRI   = self::OPENING_HOURS_FIELDSET . "-mon-fri";
    const OPENING_HOURS_MONDAY    = self::OPENING_HOURS_FIELDSET . "-monday";
    const OPENING_HOURS_TUESDAY   = self::OPENING_HOURS_FIELDSET . "-tuesday";
    const OPENING_HOURS_WEDNESDAY = self::OPENING_HOURS_FIELDSET . "-wednesday";
    const OPENING_HOURS_THURSDAY  = self::OPENING_HOURS_FIELDSET . "-thursday";
    const OPENING_HOURS_FRIDAY    = self::OPENING_HOURS_FIELDSET . "-friday";
    const OPENING_HOURS_SATURDAY  = self::OPENING_HOURS_FIELDSET . "-saturday";
    const OPENING_HOURS_SUNDAY    = self::OPENING_HOURS_FIELDSET . "-sunday";

    public static function getOpeningHoursFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::OPENING_HOURS_FIELDSET, __("Otevírací doba", ADMIN_DOMAIN));
        $fieldset->setPostPrefix(self::OPENING_HOURS_FIELDSET);

        $fieldset->addText(self::OPENING_HOURS_MON_FRI, __("Po-Pá:", ADMIN_DOMAIN));
        $fieldset->addText(self::OPENING_HOURS_MONDAY, __("Pondělí:", ADMIN_DOMAIN));
        $fieldset->addText(self::OPENING_HOURS_TUESDAY, __("Úterý:", ADMIN_DOMAIN));
        $fieldset->addText(self::OPENING_HOURS_WEDNESDAY, __("Středa:", ADMIN_DOMAIN));
        $fieldset->addText(self::OPENING_HOURS_THURSDAY, __("Čtvrtek:", ADMIN_DOMAIN));
        $fieldset->addText(self::OPENING_HOURS_FRIDAY, __("Pátek:", ADMIN_DOMAIN));
        $fieldset->addText(self::OPENING_HOURS_SATURDAY, __("Sobota:", ADMIN_DOMAIN));
        $fieldset->addText(self::OPENING_HOURS_SUNDAY, __("Neděle:", ADMIN_DOMAIN));

        return $fieldset;
    }

    // --- ANALYTIKA ------------------------

    const ANALYTICS_FIELDSET    = self::FORM_PREFIX . "-analytics";
    const ANALYTICS_HEADER_CODE = self::ANALYTICS_FIELDSET . "-header-code";
    const ANALYTICS_BODY_CODE   = self::ANALYTICS_FIELDSET . "-body-code";

    public static function getAnalyticsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::ANALYTICS_FIELDSET, __("Analytika", ADMIN_DOMAIN));
        $fieldset->setPostPrefix(self::ANALYTICS_FIELDSET);

        $fieldset->addTextarea(self::ANALYTICS_HEADER_CODE, __("Kód v header:", ADMIN_DOMAIN))
            ->setFilterSanitize(FILTER_DEFAULT);

        $fieldset->addTextarea(self::ANALYTICS_BODY_CODE, __("Kód v body:", ADMIN_DOMAIN))
            ->setFilterSanitize(FILTER_DEFAULT);

        return $fieldset;
    }
}
