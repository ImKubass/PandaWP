<?php

namespace Components\FooterHeaderSettings;

class FooterHeaderSettingsFactory
{
    private static $FooterHeader = null;

    /** @return FooterHeaderSettingsModel */
    public static function create()
    {
        if (isset(self::$FooterHeader)) {
            return self::$FooterHeader;
        }
        $FooterHeader = new FooterHeaderSettingsModel();
        return self::$FooterHeader = $FooterHeader;
    }
}