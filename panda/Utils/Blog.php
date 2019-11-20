<?php

namespace Utils;

class Blog
{
    public static function getBlogPageLink()
    {
        return $url = get_permalink(get_option('page_for_posts'));
    }

    //? Issets

    public static function isBlogPage()
    {
        return !is_front_page() && is_home();
    }

    public static function isBlogPageLink()
    {
        return !empty(self::getBlogPageLink());
    }
}
