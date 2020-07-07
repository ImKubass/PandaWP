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
        if (Util::arrayIssetAndNotEmpty($src)) {
            return reset($src);
        }
    }
    public static function getImageWidth($id, $sizeConstant)
    {
        $src = wp_get_attachment_image_src($id, $sizeConstant);
        if (Util::arrayIssetAndNotEmpty($src)) {
            return $src[1];
        }
    }

    public static function getCloudImage($id, $width, $height = null, $crop = 'fill', $quality = 'auto:eco', $effect = null)
    {
        if (function_exists('cloudinary_url')) {

            // if "Auto Cloudinary" plugin exists -> get the image url with the specified and predefined parameters from Cloudinary service

            $args = [
                'transform' => [
                    'width' => $width,
                    'height' => $height,
                    'crop' => $crop,
                    'quality' => $quality,
                    'fetch_format' => 'auto',
                ],
            ];

            if ($effect) {
                $args['transform'] += ['effect' => $effect];
            }

            $image_url = cloudinary_url($id, $args);
        } elseif (function_exists('fly_add_image_size')) {

            // if "Auto Cloudinary" plugin doesn't exist but "Fly Dynamic Image Resizer" exists -> get the image with the specified width and height from local server

            $img = fly_get_attachment_image_src($id, [$width, $height], true);

            $image_url = $img['src'];
        } else {

            // if neither plugin works -> get only the url of the image from local server

            $image_url = wp_get_attachment_image_src($id)[0];
        }

        return esc_url($image_url);
    }

    public static function getImageIdByName($imageName)
    {

        $args = [
            "posts_per_page" => 1,
            "post_type"      => "attachment",
            "name"           => trim($imageName),
        ];

        $get_attachment = new \WP_Query($args);

        if (!$get_attachment || !isset($get_attachment->posts, $get_attachment->posts[0])) {
            return false;
        }

        return $get_attachment->posts[0]->ID;
    }
}
