<?php

namespace Utils;

use Components\ThemeSettings\ThemeSettingsFactory;

class Util
{

    public static function renderAnalyticsHeaderCode()
    {
        $ThemeModel = ThemeSettingsFactory::create();
        if ($ThemeModel->isAnalyticsHeaderCode()) {
            echo $ThemeModel->getAnalyticsHeaderCode();
        }
    }

    public static function renderAnalyticsBodyCode()
    {
        $ThemeModel = ThemeSettingsFactory::create();
        if ($ThemeModel->isAnalyticsBodyCode()) {
            echo $ThemeModel->getAnalyticsBodyCode();
        }
    }

    public static function renderCompatibilityScript()
    {
        echo "<!--[if lt IE 9]><script src=\"https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js\"></script><script src=\"https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js\"></script><![endif]-->";
    }

    public static function getTranslatesByKeys(array $Translates, array $Keys)
    {
        $Items = [];

        foreach ($Keys as $Key => $KeyConstant) {

            foreach ($Translates as $TranslateKey => $TranslateValue) {
                if ($KeyConstant == $TranslateKey) {
                    array_push($Items, $TranslateValue);
                    break;
                }
            }
        }
        return $Items;
    }

    public static function getTermsIdsByPostId($Id, $TermKey)
    {
        $TermObjects = wp_get_post_terms($Id, $TermKey);
        $TermNames = [];

        /** @var \WP_Term $Term */
        foreach ($TermObjects as $Term) {
            array_push($TermNames, $Term->term_id);
        }
        return $TermNames;
    }

    public static function isDirEmpty($dir)
    {
        if (!is_readable($dir)) return NULL;
        return (count(scandir($dir)) == 2);
    }

    public static function reArrayFiles(&$file_post)
    {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);


        for ($i = 0; $i < $file_count; $i++) {

            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = array_values($file_post[$key])[$i];
            }
        }

        return $file_ary;
    }


    //? --- KT FUNCTIONS --------------------------------

    /**
     * Kontrola na isset a ! empty v "jednom" kroku
     *
     * @author Martin Hlaváč
     *
     * @param mixed $value
     * @return boolean
     */
    public static function issetAndNotEmpty($value)
    {
        return isset($value) && !empty($value);
    }

    /**
     * Kontrola, zda je zadaný parameter přiřezený, typu pole a má jeden nebo více záznamů
     *
     * @author Martin Hlaváč
     *
     * @param array $array
     * @return boolean
     */
    public static function arrayIssetAndNotEmpty($array = null)
    {
        return isset($array) && is_array($array) && count($array) > 0;
    }

    /**
     * Ze zadaného pole odstraní zadaný klíč (i s hodnotou)
     *
     * @author Martin Hlaváč
     *
     * @param array $haystack
     * @param int|string $needle
     * @return array
     */
    public static function arrayRemoveByKey(array $haystack, $needle)
    {
        if (array_key_exists($needle, $haystack)) {
            unset($haystack[$needle]);
        }
        return $haystack;
    }


    /**
     * Kontrola na ! isset nebo empty v "jednom" kroku
     *
     * @author Martin Hlaváč
     * @link http://www.ktstudio.cz
     *
     * @param mixed $value
     * @return boolean
     */
    public static function notIssetOrEmpty($value)
    {
        return !isset($value) || empty($value);
    }


    /**
     * Kontrola hodnoty, jestli je číselného typu, resp. int a případné přetypování nebo rovnou návrat, jinak null
     *
     * @author Martin Hlaváč
     *
     * @param number $value
     * @return integer|null
     */
    public static function tryGetInt($value)
    {
        if (isset($value) && is_numeric($value)) {
            if (is_int($value)) {
                return $value;
            }
            return (int) $value;
        }
        if ($value === "0") {
            return (int) 0;
        }
        return null;
    }

    /**
     * Vrátí hodnotu pro zadaný klíč pokud existuje nebo výchozí zadanou hodnotu (NULL)
     *
     * @author Martin Hlaváč
     *
     * @param array $array
     * @param string $key
     * @param string $defaultValue
     * @return mixed type|null
     */
    public static function arrayTryGetValue(array $array, $key, $defaultValue = null)
    {
        if (isset($key)) {
            if (array_key_exists($key, $array)) {
                return $array[$key];
            }
        }
        return $defaultValue;
    }


    /**
     * Na základě zadaných parametrů vrátí řetezec pro programové odsazení tabulátorů s případnými novými řádky
     *
     * @author Martin Hlaváč
     *
     * @param integer $tabsCount
     * @param string $content
     * @param boolean $newLineBefore
     * @param boolean $newLineAfter
     * @return string
     */
    public static function getTabsIndent($tabsCount, $content = null, $newLineBefore = false, $newLineAfter = false)
    {
        $result = "";
        if ($newLineBefore == true) {
            $result .= "\n";
        }
        $result .= str_repeat("\t", $tabsCount);
        if (self::issetAndNotEmpty($content)) {
            $result .= $content;
        }
        if ($newLineAfter == true) {
            $result .= "\n";
        }
        return $result;
    }

    /**
     * Prověří, zda zadaný parametr je ve formátu pro ID v databázi
     * Je: Setnutý, není prázdný a je větší než 0
     *
     * @author Tomáš Kocifaj
     *
     * @param mixed $value
     * @return boolean
     */
    public static function isIdFormat($value)
    {
        $id = self::tryGetInt($value);
        if ($id > 0) {
            return true;
        }
        return false;
    }

    /**
     * Vrátí aktuální URL na základě nastavení APACHE HTTP_HOST a REQUEST_URI
     *
     * @author Martin Hlaváč
     *
     * @param boolean $fullUrl - true i s pametry, false bez
     * @return string
     */
    public static function getRequestUrl($fullUrl = true)
    {
        $requestUrl = "http";
        if (self::arrayTryGetValue($_SERVER, "HTTPS") == "on") {
            $requestUrl .= "s";
        }
        $requestUrl .= "://";
        $serverPort = $_SERVER["SERVER_PORT"];
        $serverName = $_SERVER["SERVER_NAME"];
        $httpHost = $_SERVER["HTTP_HOST"];
        $serverKey = (uString::stringEndsWith($httpHost, $serverName)) ? $httpHost : $serverName;
        $serverUri = ($fullUrl) ? $_SERVER["REQUEST_URI"] : $_SERVER["REDIRECT_URL"];
        if ($serverPort == "80" || $serverPort == "443") {
            $requestUrl .= "{$serverKey}{$serverUri}";
        } else {
            $requestUrl .= "{$serverKey}:{$serverPort}{$serverUri}";
        }
        return $requestUrl;
    }

    /**
     * Vrátí (aktuální) IP adresu z pole $_SERVER
     *
     * @author Martin Hlaváč
     * @link http://www.ktstudio.cz
     *
     * @return string
     */
    public static function getIpAddress()
    {
        $ip = self::arrayTryGetValue($_SERVER, "HTTP_CLIENT_IP")
            ?: self::arrayTryGetValue($_SERVER, "HTTP_X_FORWARDED_FOR")
            ?: self::arrayTryGetValue($_SERVER, "REMOTE_ADDR");
        return $ip;
    }

    /**
     * Escapování HTML atribuntů v zadaném textu (+ trim) nebo null
     *
     * @author Martin Hlaváč
     * @link http://www.ktstudio.cz
     *
     * @param string $text
     * @return string
     */
    public static function stringEscape($text)
    {
        if (self::issetAndNotEmpty($text)) {
            return esc_attr(trim($text));
        }
        return null;
    }

    public static function tryGetUrlParamValue($requestKey)
    {
        $requestValue = self::arrayTryGetValue($_REQUEST, $requestKey);
        if (self::issetAndNotEmpty($requestValue)) {
            return $requestValue;
        }
        return null;
    }

    public static function multiKeyExists(array $arr, $key)
    {

        // is in base array?
        if (array_key_exists($key, $arr)) {
            return true;
        }

        // check arrays contained in this array
        foreach ($arr as $element) {
            if (is_array($element)) {
                if (self::multiKeyExists($element, $key)) {
                    return true;
                }
            }
        }

        return false;
    }
}
