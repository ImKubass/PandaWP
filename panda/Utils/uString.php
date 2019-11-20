<?php

namespace Utils;


class uString
{
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
        if (Util::issetAndNotEmpty($phoneNumber)) {
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
     * Část stringu (--text--) obalí tagem strong
     * 
     * @author Jakub Jetleb
     * 
     * @param string $value
     * @return string
     */
    public static function wrapWithStrong($string)
    {
        $patterns = ["/\-\-(.+?)\-\-/i"];
        $replaces = ["<strong>$1</strong>"];
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

    //? --- KT Functions

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
