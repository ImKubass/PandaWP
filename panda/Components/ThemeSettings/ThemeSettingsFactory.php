<?php

namespace Components\ThemeSettings;

/**
 * Class ThemeSettingsFactory
 * @package Components\ThemeSettings
 */
class ThemeSettingsFactory
{
    private static $theme = null;

    public static function create(): ThemeSettingsModel
    {
        if (isset(self::$theme)) {
            return self::$theme;
        }
        return self::$theme = new ThemeSettingsModel();
    }
}
