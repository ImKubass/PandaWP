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
            self::SERVICE_OFFER_SECTION_FIELDSET => self::getServiceOfferectionFieldset(),
            self::HEATING_SECTION_FIELDSET => self::getHeatingSectionFieldset(),
            self::START_HEATING_SECTION_FIELDSET => self::getStartHeatingSectionFieldset(),
            self::IMPORTANT_PAGES_FIELDSET => self::getImportantPagesFieldset(),
            self::POSTS_FIELDSET => self::getPostsFieldset(),
            self::SOCIAL_FIELDSET => self::getSocialFieldset(),
            self::CONTACT_FIELDSET => self::getContactFieldset(),
            self::OPENING_HOURS_FIELDSET => self::getOpeningHoursFieldset(),
            self::GOOGLE_API_FIELDSET => self::getGoogleApiFieldset(),
            self::MEETINGS_SETTINGS_FIELDSET => self::getMeetingsSettingsFieldset(),
            self::ANALYTICS_FIELDSET => self::getAnalyticsFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    // --- Nabídka služeb ------------------------

    const SERVICE_OFFER_SECTION_FIELDSET = self::FORM_PREFIX . "-service-offcer-section";
    const SERVICE_OFFER_SECTION_TITLE = self::SERVICE_OFFER_SECTION_FIELDSET . "-title";
    const SERVICE_OFFER_SECTION_DESCRIPTION = self::SERVICE_OFFER_SECTION_FIELDSET . "-description";
    const SERVICE_OFFER_SECTION_PAGE_FIRST_ID = self::SERVICE_OFFER_SECTION_FIELDSET . "-page-first-id";
    const SERVICE_OFFER_SECTION_PAGE_SECOND_ID = self::SERVICE_OFFER_SECTION_FIELDSET . "-page-second-id";
    const SERVICE_OFFER_SECTION_PAGE_THIRD_ID = self::SERVICE_OFFER_SECTION_FIELDSET . "-page-third-id";
    const SERVICE_OFFER_SECTION_PAGE_FOURTH_ID = self::SERVICE_OFFER_SECTION_FIELDSET . "-page-fourth-id";

    public static function getServiceOfferectionFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SERVICE_OFFER_SECTION_FIELDSET, __("Nabídka služeb", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::SERVICE_OFFER_SECTION_FIELDSET);



        $fieldset->addText(self::SERVICE_OFFER_SECTION_TITLE, __("Titulek:", "RLG_DOMAIN"));
        $fieldset->addTextarea(self::SERVICE_OFFER_SECTION_DESCRIPTION, __("Poisek:", "RLG_DOMAIN"));

        $fieldset->addWpPage(self::SERVICE_OFFER_SECTION_PAGE_FIRST_ID, __("První dopadová stránka:", "RLG_DOMAIN"))
            ->setFirstEmpty();

        $fieldset->addWpPage(self::SERVICE_OFFER_SECTION_PAGE_SECOND_ID, __("Druhá dopadová stránka:", "RLG_DOMAIN"))
            ->setFirstEmpty();

        $fieldset->addWpPage(self::SERVICE_OFFER_SECTION_PAGE_THIRD_ID, __("Třetí dopadová stránka:", "RLG_DOMAIN"))
            ->setFirstEmpty();

        $fieldset->addWpPage(self::SERVICE_OFFER_SECTION_PAGE_FOURTH_ID, __("Čtvrtá dopadová stránka:", "RLG_DOMAIN"))
            ->setFirstEmpty();

        return $fieldset;
    }

    // --- Topení od A do Z ------------------------

    const HEATING_SECTION_FIELDSET = self::FORM_PREFIX . "-heating-section";
    const HEATING_SECTION_TITLE = self::HEATING_SECTION_FIELDSET . "-title";
    const HEATING_SECTION_DESCRIPTION = self::HEATING_SECTION_FIELDSET . "-description";

    public static function getHeatingSectionFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::HEATING_SECTION_FIELDSET, __("Topení od A do Z", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::HEATING_SECTION_FIELDSET);

        $fieldset->addText(self::HEATING_SECTION_TITLE, __("Titulek:", "RLG_DOMAIN"));
        $fieldset->addTextarea(self::HEATING_SECTION_DESCRIPTION, __("Popisek:", "RLG_DOMAIN"));

        return $fieldset;
    }

    // --- Můžete začít topit ------------------------

    const START_HEATING_SECTION_FIELDSET = self::FORM_PREFIX . "-start-heating-section";
    const START_HEATING_SECTION_TITLE = self::START_HEATING_SECTION_FIELDSET . "-title";
    const START_HEATING_SECTION_DESCRIPTION = self::START_HEATING_SECTION_FIELDSET . "-description";
    const START_HEATING_SECTION_BUTTON_TEXT = self::START_HEATING_SECTION_FIELDSET . "-button-text";

    public static function getStartHeatingSectionFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::START_HEATING_SECTION_FIELDSET, __("Můžete začít topit", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::START_HEATING_SECTION_FIELDSET);

        $fieldset->addText(self::START_HEATING_SECTION_TITLE, __("Titulek:", "RLG_DOMAIN"));
        $fieldset->addTextarea(self::START_HEATING_SECTION_DESCRIPTION, __("Popisek:", "RLG_DOMAIN"));
        $fieldset->addText(self::START_HEATING_SECTION_BUTTON_TEXT, __("Text tlačítka:", "RLG_DOMAIN"));

        return $fieldset;
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


    // --- Důležité stránky ------------------------

    const IMPORTANT_PAGES_FIELDSET = self::FORM_PREFIX . "-important-pages";
    const IMPORTANT_PAGES_CONTACT_ID = self::IMPORTANT_PAGES_FIELDSET . "-contact-id";
    const IMPORTANT_PAGES_SERVICES_ID = self::IMPORTANT_PAGES_FIELDSET . "-services-id";

    public static function getImportantPagesFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::IMPORTANT_PAGES_FIELDSET, __("Důležité stránky", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::IMPORTANT_PAGES_FIELDSET);

        $fieldset->addWpPage(self::IMPORTANT_PAGES_CONTACT_ID, __("Kontakty:", "RLG_DOMAIN"))
            ->setFirstEmpty();
        $fieldset->addWpPage(self::IMPORTANT_PAGES_SERVICES_ID, __("Služby:", "RLG_DOMAIN"))
            ->setFirstEmpty();

        return $fieldset;
    }

    // --- Články pro filtrační parametry ------------------------

    const POSTS_FIELDSET = self::FORM_PREFIX . "-posts";
    const POSTS_MANUFACTURER_ID = self::POSTS_FIELDSET . "-manufacturer-id";
    const POSTS_PERFORMANCE_ID = self::POSTS_FIELDSET . "-performance-id";
    const POSTS_HEAT_TRANSFER_ID = self::POSTS_FIELDSET . "-heat-transfer-id";
    const POSTS_AIR_SUPPLY_ID = self::POSTS_FIELDSET . "-air-supply-id";

    public static function getPostsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::POSTS_FIELDSET, __("Články pro filtrační parametry", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::POSTS_FIELDSET);

        $PostsList = new \KT_Custom_Post_Data_Manager([
            "post_type" => KT_WP_POST_KEY,
            "post_status" => "publish",
            "posts_per_page" => -1,
            "orderby" => "title",
            "order" => \KT_Repository::ORDER_ASC,
        ]);

        $fieldset->addSelect(self::POSTS_MANUFACTURER_ID, __("Výrobce:", "RLG_DOMAIN"))
            ->setDataManager($PostsList)
            ->setFirstEmpty();

        $fieldset->addSelect(self::POSTS_PERFORMANCE_ID, __("Výkon:", "RLG_DOMAIN"))
            ->setDataManager($PostsList)
            ->setFirstEmpty();

        $fieldset->addSelect(self::POSTS_HEAT_TRANSFER_ID, __("Předávání tepla:", "RLG_DOMAIN"))
            ->setDataManager($PostsList)
            ->setFirstEmpty();

        $fieldset->addSelect(self::POSTS_AIR_SUPPLY_ID, __("Přívod vzduchu:", "RLG_DOMAIN"))
            ->setDataManager($PostsList)
            ->setFirstEmpty();


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

    // --- GOOGLE API ------------------------

    const GOOGLE_API_FIELDSET = self::FORM_PREFIX . "-google-api";
    const GOOGLE_API_CLIENT_ID = self::GOOGLE_API_FIELDSET . "-client-id";
    const GOOGLE_API_CLIENT_SECRET = self::GOOGLE_API_FIELDSET . "-client-secret";
    const GOOGLE_API_CALENDAR_ID = self::GOOGLE_API_FIELDSET . "-calendar-id";

    public static function getGoogleApiFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::GOOGLE_API_FIELDSET, __("Google API", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::GOOGLE_API_FIELDSET);

        $fieldset->addPassword(self::GOOGLE_API_CLIENT_ID, "Client ID:");
        $fieldset->addPassword(self::GOOGLE_API_CLIENT_SECRET, "Client Secret:");
        $fieldset->addPassword(self::GOOGLE_API_CALENDAR_ID, "Calendar ID:");

        return $fieldset;
    }

    // --- Nastavení schůzek ------------------------

    const MEETINGS_SETTINGS_FIELDSET = self::FORM_PREFIX .  "-settings";
    const MEETINGS_SETTINGS_LENGTH = self::MEETINGS_SETTINGS_FIELDSET .  "-length";

    public static function getMeetingsSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::MEETINGS_SETTINGS_FIELDSET, __("Nastavení schůzek ", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::MEETINGS_SETTINGS_FIELDSET);

        $MeetingsLength = new MeetingLengthsEnum();
        $MeetingsLengthOptions = Util::arrayRemoveByKey($MeetingsLength->getTranslates(), MeetingLengthsEnum::NONE);

        $fieldset->addSelect(self::MEETINGS_SETTINGS_LENGTH, __("Délka schůzek:", "RLG_DOMAIN"))
            ->setOptionsData($MeetingsLengthOptions)
            ->setDefaultValue($MeetingsLength::SIXTY);

        return $fieldset;
    }
}