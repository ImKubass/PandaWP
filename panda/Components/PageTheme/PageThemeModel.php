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


    //? --- veřejné metody ------------------------------------------------------


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
