<?php

namespace Components\PageTheme;

use Utils\Util;

class PageThemeModel extends \KT_WP_Options_Base_Model
{

    private $SocialsSameAsData;
    private $ContactLogoSrc;


    public function __construct()
    {
        parent::__construct(PageThemeConfig::FORM_PREFIX);
    }

    //? --- getry & setry ------------------------

    //* --- Nabídka služeb
    //* --- Prefix: ServiceOfferSection

    public function getServiceOfferSectionTitle()
    {
        return $this->getOption(PageThemeConfig::SERVICE_OFFER_SECTION_TITLE);
    }

    public function getServiceOfferSectionTitleFancy()
    {
        return Util::wrapWithSpan($this->getServiceOfferSectionTitle());
    }

    public function getServiceOfferSectionDescription()
    {
        return $this->getOption(PageThemeConfig::SERVICE_OFFER_SECTION_DESCRIPTION);
    }

    public function getServiceOfferSectionPageFirstId()
    {
        return $this->getOption(PageThemeConfig::SERVICE_OFFER_SECTION_PAGE_FIRST_ID);
    }

    public function getServiceOfferSectionPageSecondId()
    {
        return $this->getOption(PageThemeConfig::SERVICE_OFFER_SECTION_PAGE_SECOND_ID);
    }

    public function getServiceOfferSectionPageThirdId()
    {
        return $this->getOption(PageThemeConfig::SERVICE_OFFER_SECTION_PAGE_THIRD_ID);
    }

    public function getServiceOfferSectionPageFourthId()
    {
        return $this->getOption(PageThemeConfig::SERVICE_OFFER_SECTION_PAGE_FOURTH_ID);
    }

    public function getServiceOfferSectionPagesIds()
    {

        $PagesIds = [];

        if ($this->isServiceOfferSectionPageFirstId()) {
            array_push($PagesIds, $this->getServiceOfferSectionPageFirstId());
        }

        if ($this->isServiceOfferSectionPageSecondId()) {
            array_push($PagesIds, $this->getServiceOfferSectionPageSecondId());
        }

        if ($this->isServiceOfferSectionPageThirdId()) {
            array_push($PagesIds, $this->getServiceOfferSectionPageThirdId());
        }

        if ($this->isServiceOfferSectionPageFourthId()) {
            array_push($PagesIds, $this->getServiceOfferSectionPageFourthId());
        }

        return $PagesIds;
    }

    //* --- Topení od A do Z
    //* --- Prefix: HeatingSection

    public function getHeatingSectionTitle()
    {
        return $this->getOption(PageThemeConfig::HEATING_SECTION_TITLE);
    }

    public function getHeatingSectionTitleFancy()
    {
        return Util::wrapWithSpan($this->getHeatingSectionTitle());
    }

    public function getHeatingSectionDescription()
    {
        return $this->getOption(PageThemeConfig::HEATING_SECTION_DESCRIPTION);
    }

    //* --- Můžete začít topit
    //* --- Prefix: StartHeatingSection

    public function getStartHeatingSectionTitle()
    {
        return $this->getOption(PageThemeConfig::START_HEATING_SECTION_TITLE);
    }

    public function getStartHeatingSectionDescription()
    {
        return $this->getOption(PageThemeConfig::START_HEATING_SECTION_DESCRIPTION);
    }

    public function getStartHeatingSectionButtonText()
    {
        return $this->getOption(PageThemeConfig::START_HEATING_SECTION_BUTTON_TEXT);
    }

    //* --- Články pro filtrační parametry
    //* --- Prefix: Posts

    public function getPostsManufacturerId()
    {
        return $this->getOption(PageThemeConfig::POSTS_MANUFACTURER_ID);
    }

    public function getPostsPerformanceId()
    {
        return $this->getOption(PageThemeConfig::POSTS_PERFORMANCE_ID);
    }

    public function getPostsPerformanceLink()
    {
        return get_permalink($this->getPostsPerformanceId());
    }

    public function getPostsPerformanceTitle()
    {
        return get_the_title($this->getPostsPerformanceId());
    }

    public function getPostsHeatTransferId()
    {
        return $this->getOption(PageThemeConfig::POSTS_HEAT_TRANSFER_ID);
    }

    public function getPostsHeatTransferLink()
    {
        return get_permalink($this->getPostsHeatTransferId());
    }

    public function getPostsHeatTransferTitle()
    {
        return get_the_title($this->getPostsHeatTransferId());
    }

    public function getPostsAirSupplyId()
    {
        return $this->getOption(PageThemeConfig::POSTS_AIR_SUPPLY_ID);
    }

    public function getPostsAirSupplyLink()
    {
        return get_permalink($this->getPostsAirSupplyId());
    }

    public function getPostsAirSupplyTitle()
    {
        return get_the_title($this->getPostsAirSupplyId());
    }


    //* --- Důležité stránky
    //* --- Prefix: ImportantPages

    public function getImportantPagesContactId()
    {
        return $this->getOption(PageThemeConfig::IMPORTANT_PAGES_CONTACT_ID);
    }

    public function getImportantPagesContactLink()
    {
        if ($this->isImportantPagesContactId()) {
            return $url = get_permalink($this->getImportantPagesContactId());
        }
    }

    public function getImportantPagesServicesId()
    {
        return $this->getOption(PageThemeConfig::IMPORTANT_PAGES_SERVICES_ID);
    }

    public function getImportantPagesServicesLink()
    {
        if ($this->isImportantPagesServicesId()) {
            return $url = get_permalink($this->getImportantPagesServicesId());
        }
    }


    //* --- Kontakt
    //* --- Prefix: Contact

    public function getContactCompanyName()
    {
        return $this->getOption(PageThemeConfig::CONTACT_COMPANY_NAME);
    }

    public function getContactStreet()
    {
        return $this->getOption(PageThemeConfig::CONTACT_STREET);
    }

    public function getContactCity()
    {
        return $this->getOption(PageThemeConfig::CONTACT_CITY);
    }

    public function getContactZip()
    {
        return $this->getOption(PageThemeConfig::CONTACT_ZIP);
    }

    public function getContactPhone()
    {
        return $this->getOption(PageThemeConfig::CONTACT_PHONE);
    }

    public function getContactPhoneClean()
    {
        return Util::clearPhoneNumber($this->getContactPhone());
    }

    public function getContactPhoneFancy()
    {
        return Util::phoneNumberFormat($this->getContactPhone());
    }

    public function getContactEmail()
    {
        return $this->getOption(PageThemeConfig::CONTACT_EMAIL);
    }

    public function getContactEmailFancy()
    {
        $email = $this->getContactEmail();
        $wordToFind  = '@';
        $wrap_before = '<span>';
        $wrap_after  = '</span>';

        $fancyEmail = preg_replace("/($wordToFind)/i", "$wrap_before$1$wrap_after", $email);
        return $fancyEmail;
    }

    public function getContactDescription()
    {
        return $this->getOption(PageThemeConfig::CONTACT_DESCRIPTION);
    }

    public function getContactEstablishment()
    {
        return $this->getOption(PageThemeConfig::CONTACT_ESTABLISHMENT);
    }

    public function getContactDic()
    {
        return $this->getOption(PageThemeConfig::CONTACT_DIC);
    }

    public function getContactIco()
    {
        return $this->getOption(PageThemeConfig::CONTACT_ICO);
    }

    public function getContactLogoId()
    {
        return $this->getOption(PageThemeConfig::CONTACT_LOGO_ID);
    }

    /** @return string */
    public function getContactLogoSrc()
    {
        if (isset($this->ContactLogoSrc)) {
            return $this->ContactLogoSrc;
        }

        if ($this->isContactLogoId()) {
            return $this->ContactLogoSrc = Util::getImageSrc($this->getContactLogoId(), KT_WP_IMAGE_SIZE_ORIGINAL);
        }

        return $this->ContactLogoSrc = "";
    }

    public function getContactAdressFull()
    {
        return $adress = $this->getContactStreet() . ", " . $this->getContactCity();
    }


    //* --- Sociání sítě
    //* --- Prefix: Social

    public function getSocialFacebook()
    {
        return $this->getOption(PageThemeConfig::SOCIAL_FACEBOOK);
    }

    public function getSocialInstagram()
    {
        return $this->getOption(PageThemeConfig::SOCIAL_INSTAGRAM);
    }

    public function getSocialYouTube()
    {
        return $this->getOption(PageThemeConfig::SOCIAL_YOUTUBE);
    }

    /** @return array */
    public function getSocialsSameAsData()
    {
        if (isset($this->SocialsSameAsData)) {
            return $this->SocialsSameAsData;
        }
        $data = [];
        if ($this->isSocialFacebook()) {
            $data[] = sprintf("%s - social network profile (Facebook)", $this->getSocialFacebook());
        }
        if ($this->isSocialInstagram()) {
            $data[] = sprintf("%s - social network profile (Instagram)", $this->getSocialInstagram());
        }
        if ($this->isSocialYoutube()) {
            $data[] = sprintf("%s - social network profile (YouTube)", $this->getSocialYoutube());
        }
        return $this->SocialsSameAsData = $data;
    }

    //* --- Otevírací doba
    //* --- Prefix: OpeningHours

    public function getOpeningHoursMonFri()
    {
        return $this->getOption(PageThemeConfig::OPENING_HOURS_MON_FRI);
    }

    public function getOpeningHoursMonday()
    {
        return $this->getOption(PageThemeConfig::OPENING_HOURS_MONDAY);
    }

    public function getOpeningHoursTuesday()
    {
        return $this->getOption(PageThemeConfig::OPENING_HOURS_TUESDAY);
    }

    public function getOpeningHoursWednesday()
    {
        return $this->getOption(PageThemeConfig::OPENING_HOURS_WEDNESDAY);
    }

    public function getOpeningHoursThursday()
    {
        return $this->getOption(PageThemeConfig::OPENING_HOURS_THURSDAY);
    }

    public function getOpeningHoursFriday()
    {
        return $this->getOption(PageThemeConfig::OPENING_HOURS_FRIDAY);
    }

    public function getOpeningHoursSaturday()
    {
        return $this->getOption(PageThemeConfig::OPENING_HOURS_SATURDAY);
    }

    public function getOpeningHoursSunday()
    {
        return $this->getOption(PageThemeConfig::OPENING_HOURS_SUNDAY);
    }

    //* --- Analytika
    //* --- Prefix: Analytics

    public function getAnalyticsHeaderCode()
    {
        return $this->getOption(PageThemeConfig::ANALYTICS_HEADER_CODE);
    }

    public function getAnalyticsBodyCode()
    {
        return $this->getOption(PageThemeConfig::ANALYTICS_BODY_CODE);
    }

    //* --- Google kalendář
    //* --- Prefix: GoogleApi

    public function getGoogleApiClientId()
    {
        return $this->getOption(PageThemeConfig::GOOGLE_API_CLIENT_ID);
    }

    public function getGoogleApiClientSecret()
    {
        return $this->getOption(PageThemeConfig::GOOGLE_API_CLIENT_SECRET);
    }

    public function getGoogleApiCalendarId()
    {
        return $this->getOption(PageThemeConfig::GOOGLE_API_CALENDAR_ID);
    }

    // --- Nastavení kalendáře
    // --- Prefix: MeetingsSettings

    public function getMeetingsSettingsLength()
    {
        return $this->getOption(PageThemeConfig::MEETINGS_SETTINGS_LENGTH);
    }


    //? --- veřejné metody ------------------------------------------------------

    //* --- Nabídka služeb
    //* --- Prefix: ServiceOfferSection

    public function isServiceOfferSectionTitle()
    {
        return Util::issetAndNotEmpty($this->getServiceOfferSectionTitle());
    }

    public function isServiceOfferSectionDescription()
    {
        return Util::issetAndNotEmpty($this->getServiceOfferSectionDescription());
    }

    public function isServiceOfferSectionPageFirstId()
    {
        return Util::issetAndNotEmpty($this->getServiceOfferSectionPageFirstId());
    }

    public function isServiceOfferSectionPageSecondId()
    {
        return Util::issetAndNotEmpty($this->getServiceOfferSectionPageSecondId());
    }

    public function isServiceOfferSectionPageThirdId()
    {
        return Util::issetAndNotEmpty($this->getServiceOfferSectionPageThirdId());
    }

    public function isServiceOfferSectionPageFourthId()
    {
        return Util::issetAndNotEmpty($this->getServiceOfferSectionPageFourthId());
    }


    //* --- Topení od A do Z
    //* --- Prefix: HeatingSection

    public function isHeatingSectionTitle()
    {
        return Util::issetAndNotEmpty($this->getHeatingSectionTitle());
    }

    public function isHeatingSectionDescription()
    {
        return Util::issetAndNotEmpty($this->getHeatingSectionDescription());
    }


    //* --- Můžete začít topit
    //* --- Prefix: StartHeatingSection

    public function isStartHeatingSectionTitle()
    {
        return Util::issetAndNotEmpty($this->getStartHeatingSectionTitle());
    }

    public function isStartHeatingSectionDescription()
    {
        return Util::issetAndNotEmpty($this->getStartHeatingSectionDescription());
    }

    public function isStartHeatingSectionButtonText()
    {
        return Util::issetAndNotEmpty($this->getStartHeatingSectionButtonText());
    }


    //* --- Články pro filtrační parametry
    //* --- Prefix: Posts

    public function isPostsManufacturerId()
    {
        return Util::issetAndNotEmpty($this->getPostsManufacturerId());
    }

    public function isPostsPerformanceId()
    {
        return Util::issetAndNotEmpty($this->getPostsPerformanceId());
    }

    public function isPostsHeatTransferId()
    {
        return Util::issetAndNotEmpty($this->getPostsHeatTransferId());
    }

    public function isPostsAirSupplyId()
    {
        return Util::issetAndNotEmpty($this->getPostsAirSupplyId());
    }

    public function isPostsIds()
    {
        return Util::arrayIssetAndNotEmpty($this->getPostsids());
    }


    //* --- Důležité stránky
    //* --- Prefix: ImportantPages

    public function isImportantPagesContactId()
    {
        return Util::issetAndNotEmpty($this->getImportantPagesContactId());
    }

    public function isImportantPagesServicesId()
    {
        return Util::issetAndNotEmpty($this->getImportantPagesServicesId());
    }


    //* --- Kontakt
    //* --- Prefix: Contact

    public function isContactCompanyName()
    {
        return Util::issetAndNotEmpty($this->getContactCompanyName());
    }

    public function isContactStreet()
    {
        return Util::issetAndNotEmpty($this->getContactStreet());
    }

    public function isContactCity()
    {
        return Util::issetAndNotEmpty($this->getContactCity());
    }

    public function isContactZip()
    {
        return Util::issetAndNotEmpty($this->getContactZip());
    }

    public function isContactPhone()
    {
        return Util::issetAndNotEmpty($this->getContactPhone());
    }

    public function isContactEmail()
    {
        return Util::issetAndNotEmpty($this->getContactEmail());
    }

    public function isContactDescription()
    {
        return Util::issetAndNotEmpty($this->getContactDescription());
    }

    public function isContactEstablishment()
    {
        return Util::issetAndNotEmpty($this->getContactEstablishment());
    }

    public function isContactDic()
    {
        return Util::issetAndNotEmpty($this->getContactDic());
    }

    public function isContactIco()
    {
        return Util::issetAndNotEmpty($this->getContactIco());
    }

    public function isContactLogoId()
    {
        return Util::issetAndNotEmpty($this->getContactLogoId());
    }

    public function isContactAdress()
    {
        return $this->isContactStreet() && $this->isContactCity() && $this->isContactZip();
    }

    //* --- Sociání sítě
    //* --- Prefix: Social

    public function isSocialFacebook()
    {
        return Util::issetAndNotEmpty($this->getSocialFacebook());
    }

    public function isSocialInstagram()
    {
        return Util::issetAndNotEmpty($this->getSocialInstagram());
    }

    public function isSocialYouTube()
    {
        return Util::issetAndNotEmpty($this->getSocialYouTube());
    }

    public function isSocials()
    {
        if ($this->isSocialFacebook() || $this->isSocialInstagram() || $this->isSocialYouTube()) {
            return true;
        } else {
            return false;
        }
    }

    public function isSocialsSameAsData()
    {
        return Util::arrayIssetAndNotEmpty($this->getSocialsSameAsData());
    }

    //* --- Otevírací doba
    //* --- Prefix: OpeningHours

    public function isOpeningHoursMonFri()
    {
        return Util::issetAndNotEmpty($this->getOpeningHoursMonFri());
    }

    public function isOpeningHoursMonday()
    {
        return Util::issetAndNotEmpty($this->getOpeningHoursMonday());
    }

    public function isOpeningHoursTuesday()
    {
        return Util::issetAndNotEmpty($this->getOpeningHoursTuesday());
    }

    public function isOpeningHoursWednesday()
    {
        return Util::issetAndNotEmpty($this->getOpeningHoursWednesday());
    }

    public function isOpeningHoursThursday()
    {
        return Util::issetAndNotEmpty($this->getOpeningHoursThursday());
    }

    public function isOpeningHoursFriday()
    {
        return Util::issetAndNotEmpty($this->getOpeningHoursFriday());
    }

    public function isOpeningHoursSaturday()
    {
        return Util::issetAndNotEmpty($this->getOpeningHoursSaturday());
    }

    public function isOpeningHoursSunday()
    {
        return Util::issetAndNotEmpty($this->getOpeningHoursSunday());
    }

    //* --- Google kalendář
    //* --- Prefix: GoogleApi

    public function isGoogleApiClientId()
    {
        return Util::issetAndNotEmpty($this->getGoogleApiClientId());
    }

    public function isGoogleApiClientSecret()
    {
        return Util::issetAndNotEmpty($this->getGoogleApiClientSecret());
    }

    public function isGoogleApiCalendarId()
    {
        return Util::issetAndNotEmpty($this->getGoogleApiCalendarId());
    }

    //* --- Nastavení kalendáře
    //* --- Prefix: MeetingsSettings

    public function isMeetingsSettingsLength()
    {
        return Util::issetAndNotEmpty($this->getMeetingsSettingsLength());
    }


    //* --- Analytika
    //* --- Prefix: Analytics

    public function isAnalyticsHeaderCode()
    {
        return Util::issetAndNotEmpty($this->getAnalyticsHeaderCode());
    }

    public function isAnalyticsBodyCode()
    {
        return Util::issetAndNotEmpty($this->getAnalyticsBodyCode());
    }
}
