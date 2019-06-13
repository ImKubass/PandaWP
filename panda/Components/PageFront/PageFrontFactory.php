<?php

namespace Components\PageFront;

class PageFrontFactory
{
    private static $pageFront = null;

    /** @return PageFrontModel */
    public static function create()
    {

        if (isset(self::$pageFront)) {
            return self::$pageFront;
        }
        global $post;
        $frontPageId = get_option(KT_WP_OPTION_KEY_FRONT_PAGE);
        if (isset($post) && $post->ID == $frontPageId) {
            $pageFront = new PageFrontModel($post);
        } else {
            $pageFront = new PageFrontModel(get_post($frontPageId));
        }
        return self::$pageFront = $pageFront;
    }
}
