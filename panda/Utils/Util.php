<?php

namespace Utils;

use Components\PageTheme\PageThemeFactory;

class Util
{

    /** @deprecated */
    public static function getHeader()
    {
        get_template_part(COMPONENTS_PATH . "Header/Header");
    }

    /** @deprecated */
    public static function getFooter()
    {
        get_template_part(COMPONENTS_PATH . "Footer/Footer");
    }

    public static function renderAnalyticsHeaderCode()
    {
        $ThemeModel = PageThemeFactory::create();
        if ($ThemeModel->isAnalyticsHeaderCode()) {
            echo $ThemeModel->getAnalyticsHeaderCode();
        }
    }

    public static function renderAnalyticsBodyCode()
    {
        $ThemeModel = PageThemeFactory::create();
        if ($ThemeModel->isAnalyticsBodyCode()) {
            echo $ThemeModel->getAnalyticsBodyCode();
        }
    }

    public static function renderCompatibilityScript()
    {
        echo "<!--[if lt IE 9]><script src=\"https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js\"></script><script src=\"https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js\"></script><![endif]-->";
    }

    /**
     * Vykreslí svg soubor ze složky šablony
     * 
     * @author Jakub Jetleb
     * 
     * @param string $fileName
     * @return string
     */
    public static function renderSvg($fileName)
    {
        $svgPath = TEMPLATEPATH . "/images/ico/$fileName.svg";

        if (file_exists($svgPath)) {
            return file_get_contents($svgPath, false);
        }
    }

    /**
     * Vykreslí svg soubor, ze zadané url adresy k souboru
     * 
     * @author Jakub Jetleb
     * 
     * @param string $fileName
     * @return string
     */
    public static function renderSvgAbsolute($filePath)
    {
        $path = parse_url($filePath, PHP_URL_PATH);

        $absolutePath = $_SERVER['DOCUMENT_ROOT'] . $path;
        $pathInfo = pathinfo($absolutePath);

        if ($pathInfo["extension"] == "svg" && file_exists($absolutePath)) {
            return file_get_contents($absolutePath);
        }
    }

    /**
     * Vyčistí zadané číslo od mezer
     * 
     * @author Jakub Jetleb
     * 
     * @param string $phoneNumber
     * @return string
     */
    public static function clearPhoneNumber($phoneNumber)
    {
        if (self::issetAndNotEmpty($phoneNumber)) {
            $before = ["(", ")", " "];
            $after = ["", ""];
            return $phoneNumber = str_replace($before, $after, $phoneNumber);
        }
    }


    /**
     * Zformátuje telefoní číslo
     * 
     * @author Jakub Jetleb
     * 
     * @param string $value
     * @return string
     */
    public static function phoneNumberFormat($value)
    {
        $value = self::clearPhoneNumber($value);
        if (is_numeric($value)) {
            if (strlen($value) == 13) {
                $firstPart = substr($value, 0, 4);
                $secondPart = substr($value, 4);
                $secondPart = wordwrap($secondPart, 3, ' ', true);
                return $value = $firstPart . " " . $secondPart;
            } else if (strlen($value) == 9) {
                return wordwrap($value, 3, ' ', true);
            }
        } else return $value;
    }

    /**
     * @param string $price
     * @return string
     */
    public static function fancyPrice($price)
    {
        if (ctype_digit($price)) {
            $price = preg_replace('/\s+/', '', $price);
            $price = number_format($price, 0, '-', ' ');
            $price .= "&nbspKč";
        }
        return $price;
    }

    /**
     * Vrátí src obrázku podle ID a velikosti
     * @param string $id
     * @param string $sizeConstant
     * @return string
     */
    public static function getImageSrc($id, $sizeConstant)
    {
        $src = wp_get_attachment_image_src($id, $sizeConstant);
        if (self::arrayIssetAndNotEmpty($src)) {
            return reset($src);
        }
    }

    /**
     * Část stringu (**text**) obalí spanem
     * 
     * @author Jakub Jetleb
     * 
     * @param string $value
     * @return string
     */
    public static function wrapWithSpan($string)
    {
        $patterns = ["/\*\*(.+?)\*\*/i"];
        $replaces = ["<span>$1</span>"];
        return preg_replace($patterns, $replaces, $string);
    }

    /**
     * Najde {##} a přepíše na break tag (<br>)
     * 
     * @author Jakub Jetleb
     * 
     * @param string $value
     * @return string
     */
    public static function renderBreakTagInString($string)
    {
        $wordToFind  = "##";
        $replace = "<br>";
        return str_replace($wordToFind, $replace, $string);
    }

    /**
     * Odstraní {##}, {**} ze zadaného stringu
     * 
     * @author Jakub Jetleb
     * 
     * @param string $string
     * @return string
     */
    public static function cleanStringFromSpecialCharacters($string)
    {
        return $string = str_replace(["##", "**"], "", $string);
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
            return (int)$value;
        }
        if ($value === "0") {
            return (int)0;
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
     * Vrátí odkaz na obrázek, který je ve složce images v rootu šablony
     * 
     * @author Tomáš Kocifaj
     * 
     * @param string $fileName
     * @return string
     */
    public static function imageGetUrlFromTheme($fileName)
    {
        return $url = get_template_directory_uri() . "/images/" . $fileName;
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
        $serverKey = (self::stringEndsWith($httpHost, $serverName)) ? $httpHost : $serverName;
        $serverUri = ($fullUrl) ? $_SERVER["REQUEST_URI"] : $_SERVER["REDIRECT_URL"];
        if ($serverPort == "80" || $serverPort == "443") {
            $requestUrl .= "{$serverKey}{$serverUri}";
        } else {
            $requestUrl .= "{$serverKey}:{$serverPort}{$serverUri}";
        }
        return $requestUrl;
    }

    /**
     * Kontrola, zda první zadaný textový řetezec obsahuje na svém konci ten druhý zadaný
     * 
     * @author Martin Hlaváč
     * 
     * @param string $string
     * @param string $ending
     * @return boolean
     */
    public static function stringEndsWith($string, $ending)
    {
        $length = strlen($ending);
        $string_end = substr($string, strlen($string) - $length);
        return $string_end === $ending;
    }

    /**
     * Kontrola, zda první zadaný textový řetezec obsahuje na svém začátku ten druhý zadaný
     * 
     * @author Martin Hlaváč
     * 
     * @param string $string
     * @param string $starting
     * @return boolean
     */
    public static function stringStartsWith($string, $starting)
    {
        $length = strlen($starting);
        return (substr($string, 0, $length) === $starting);
    }
}
