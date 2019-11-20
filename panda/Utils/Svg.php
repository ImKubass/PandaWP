<?php

namespace Utils;

class Svg
{
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
}
