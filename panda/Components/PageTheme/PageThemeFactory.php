<?php

namespace Components\PageTheme;

class PageThemeFactory
{
    private static $theme = null;

    /** @return PageThemeModel */
    public static function create()
    {
        if (isset(self::$theme)) {
            return self::$theme;
        }
        return self::$theme = new PageThemeModel();
    }
}
