<?php

namespace Components\FooterHeaderSettings;

use KT_WP_Options_Base_Model;
use Utils\Util;

class FooterHeaderSettingsModel extends KT_WP_Options_Base_Model
{


    public function __construct()
    {
        parent::__construct(FooterHeaderSettingsConfig::FORM_PREFIX);
    }

    //* --- getry & setry ------------------------

    //? --- Hlavička
    //? --- Prefix: Header


    //? --- Patička První sloupec
    //? --- Prefix: FooterFirstCol

    public function getFooterFirstColTitle()
    {
        return $this->getOption(FooterHeaderSettingsConfig::FOOTER_FIRST_COL_TITLE);
    }


    //? --- Patička Druhý sloupec
    //? --- Prefix: FooterFirstCol

    public function getFooterSecondColTitle()
    {
        return $this->getOption(FooterHeaderSettingsConfig::FOOTER_SECOND_COL_TITLE);
    }


    //? --- Patička Třetí sloupec
    //? --- Prefix: FooterThirdCol

    public function getFooterThirdColTitle()
    {
        return $this->getOption(FooterHeaderSettingsConfig::FOOTER_THIRD_COL_TITLE);
    }


    //* --- isssety ---------------------------

    //? --- Konkurenční výhody
    //? --- Prefix: Advantages

    public function isHeaderLogoId()
    {
        return Util::issetAndNotEmpty($this->getHeaderLogoId());
    }

    //? --- Patička První sloupec
    //? --- Prefix: FooterFirstCol

    public function isFooterFirstColTitle()
    {
        return Util::issetAndNotEmpty($this->getFooterFirstColTitle());
    }


    //? --- Patička Druhý sloupec
    //? --- Prefix: FooterFirstCol

    public function isFooterSecondColTitle()
    {
        return Util::issetAndNotEmpty($this->getFooterSecondColTitle());
    }

    //? --- Patička Třetí sloupec
    //? --- Prefix: FooterFirstCol

    public function isFooterThirdColTitle()
    {
        return Util::issetAndNotEmpty($this->getFooterThirdColTitle());
    }

    //? --- Patička Čtvrtý sloupec
    //? --- Prefix: FooterFourthCol

    public function isFooterFourthColTitle()
    {
        return Util::issetAndNotEmpty($this->getFooterFourthColTitle());
    }
}
