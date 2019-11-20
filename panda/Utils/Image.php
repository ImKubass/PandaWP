<?php

namespace Utils;

class Image
{

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
}
