<?php

namespace Components\ThemeSettings;

class ThemeSettingsFactory
{
    private static $theme = null;

    /** @return ThemeSettingsModel */
    public static function create()
    {
        if (isset(self::$theme)) {
            return self::$theme;
        }
        return self::$theme = new ThemeSettingsModel();
    }
}
