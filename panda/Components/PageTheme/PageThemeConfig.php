<?php

namespace Components\PageTheme;

use Enums\MeetingLengthsEnum;
use Utils\Util;

class PageThemeConfig implements \KT_Configable
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

    // --- SOCIÁLNÍ SÍTĚ ------------------------

    const SOCIAL_FIELDSET = self::FORM_PREFIX . "-social";
    const SOCIAL_FACEBOOK = self::SOCIAL_FIELDSET . "-facebook";
    const SOCIAL_INSTAGRAM = self::SOCIAL_FIELDSET . "-instagram";
    const SOCIAL_YOUTUBE = self::SOCIAL_FIELDSET . "-youtube";


    public static function getSocialFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SOCIAL_FIELDSET, __("Sociální sítě", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::SOCIAL_FIELDSET);

        $fieldset->addText(self::SOCIAL_FACEBOOK, __("Facebook:", "RLG_DOMAIN"))
            ->setInputType(\KT_Text_Field::INPUT_URL);
        $fieldset->addText(self::SOCIAL_INSTAGRAM, __("Instagram:", "RLG_DOMAIN"))
            ->setInputType(\KT_Text_Field::INPUT_URL);
        $fieldset->addText(self::SOCIAL_YOUTUBE, __("YouTube:", "RLG_DOMAIN"))
            ->setInputType(\KT_Text_Field::INPUT_URL);

        return $fieldset;
    }


    // --- KONTAKTY ------------------------

    const CONTACT_FIELDSET = self::FORM_PREFIX . "-contact";
    const CONTACT_COMPANY_NAME = self::CONTACT_FIELDSET . "-name";
    const CONTACT_STREET = self::CONTACT_FIELDSET . "-street";
    const CONTACT_CITY = self::CONTACT_FIELDSET . "-city";
    const CONTACT_ZIP = self::CONTACT_FIELDSET . "-zip";
    const CONTACT_PHONE = self::CONTACT_FIELDSET . "-contact-phone";
    const CONTACT_EMAIL = self::CONTACT_FIELDSET . "-contact-email";
    const CONTACT_DESCRIPTION = self::CONTACT_FIELDSET . "-description";
    const CONTACT_DIC = self::CONTACT_FIELDSET . "-dic";
    const CONTACT_ICO = self::CONTACT_FIELDSET . "-ico";
    const CONTACT_ESTABLISHMENT = self::CONTACT_FIELDSET . "-establishment";
    const CONTACT_LOGO_ID = self::CONTACT_FIELDSET . "-logo-id";

    public static function getContactFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::CONTACT_FIELDSET, __("Kontaktní údaje pro vyhledávače", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::CONTACT_FIELDSET);

        $fieldset->addText(self::CONTACT_COMPANY_NAME, __("Název Firmy:", "RLG_DOMAIN"));
        $fieldset->addText(self::CONTACT_STREET, __("Ulice a ČP:", "RLG_DOMAIN"));
        $fieldset->addText(self::CONTACT_CITY, __("Město:", "RLG_DOMAIN"));
        $fieldset->addText(self::CONTACT_ZIP, __("PSČ:", "RLG_DOMAIN"));
        $fieldset->addText(self::CONTACT_PHONE, __("Telefon:", "RLG_DOMAIN"));
        $fieldset->addText(self::CONTACT_EMAIL, __("E-mail:", "RLG_DOMAIN"))
            ->setInputType(\KT_Text_Field::INPUT_EMAIL)
            ->addRule(\KT_Field_Validator::EMAIL, __("E-mail musí být ve správném tvaru", "RLG_DOMAIN"));
        $fieldset->addDate(self::CONTACT_ESTABLISHMENT, __("Datum založení:", "RLG_DOMAIN"));
        $fieldset->addText(self::CONTACT_DESCRIPTION, __("Popisek:", "RLG_DOMAIN"));
        $fieldset->addText(self::CONTACT_DIC, __("DIČ:", "RLG_DOMAIN"));
        $fieldset->addText(self::CONTACT_ICO, __("IČO:", "RLG_DOMAIN"));
        $fieldset->addMedia(self::CONTACT_LOGO_ID, __("Logo:", "RLG_DOMAIN"));


        return $fieldset;
    }

    // --- Otevírací doba ------------------------

    const OPENING_HOURS_FIELDSET = self::FORM_PREFIX . "-opening-hours";
    const OPENING_HOURS_MON_FRI = self::OPENING_HOURS_FIELDSET . "-mon-fri";
    const OPENING_HOURS_MONDAY = self::OPENING_HOURS_FIELDSET . "-monday";
    const OPENING_HOURS_TUESDAY = self::OPENING_HOURS_FIELDSET . "-tuesday";
    const OPENING_HOURS_WEDNESDAY = self::OPENING_HOURS_FIELDSET . "-wednesday";
    const OPENING_HOURS_THURSDAY = self::OPENING_HOURS_FIELDSET . "-thursday";
    const OPENING_HOURS_FRIDAY = self::OPENING_HOURS_FIELDSET . "-friday";
    const OPENING_HOURS_SATURDAY = self::OPENING_HOURS_FIELDSET . "-saturday";
    const OPENING_HOURS_SUNDAY = self::OPENING_HOURS_FIELDSET . "-sunday";

    public static function getOpeningHoursFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::OPENING_HOURS_FIELDSET, __("Otevírací doba", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::OPENING_HOURS_FIELDSET);

        $fieldset->addText(self::OPENING_HOURS_MON_FRI, __("Po-Pá:", "RLG_DOMAIN"));
        $fieldset->addText(self::OPENING_HOURS_MONDAY, __("Pondělí:", "RLG_DOMAIN"));
        $fieldset->addText(self::OPENING_HOURS_TUESDAY, __("Úterý:", "RLG_DOMAIN"));
        $fieldset->addText(self::OPENING_HOURS_WEDNESDAY, __("Středa:", "RLG_DOMAIN"));
        $fieldset->addText(self::OPENING_HOURS_THURSDAY, __("Čtvrtek:", "RLG_DOMAIN"));
        $fieldset->addText(self::OPENING_HOURS_FRIDAY, __("Pátek:", "RLG_DOMAIN"));
        $fieldset->addText(self::OPENING_HOURS_SATURDAY, __("Sobota:", "RLG_DOMAIN"));
        $fieldset->addText(self::OPENING_HOURS_SUNDAY, __("Neděle:", "RLG_DOMAIN"));

        return $fieldset;
    }

    // --- ANALYTIKA ------------------------

    const ANALYTICS_FIELDSET = self::FORM_PREFIX . "-analytics";
    const ANALYTICS_HEADER_CODE = self::ANALYTICS_FIELDSET . "-header-code";
    const ANALYTICS_BODY_CODE = self::ANALYTICS_FIELDSET . "-body-code";

    public static function getAnalyticsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::ANALYTICS_FIELDSET, __("Analytika", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::ANALYTICS_FIELDSET);

        $fieldset->addTextarea(self::ANALYTICS_HEADER_CODE, __("Kód v header:", "RLG_DOMAIN"))
            ->setFilterSanitize(FILTER_DEFAULT);

        $fieldset->addTextarea(self::ANALYTICS_BODY_CODE, __("Kód v body:", "RLG_DOMAIN"))
            ->setFilterSanitize(FILTER_DEFAULT);

        return $fieldset;
    }
}
