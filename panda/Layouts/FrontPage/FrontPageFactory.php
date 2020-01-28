<?php

namespace Layouts\FrontPage;

class FrontPageFactory
{
    private static $pageFront = null;

    /** @return FrontPageModel */
    public static function create()
    {

        if (isset(self::$pageFront)) {
            return self::$pageFront;
        }
        global $post;
        $frontPageId = get_option(KT_WP_OPTION_KEY_FRONT_PAGE);
        if (isset($post) && $post->ID == $frontPageId) {
            $pageFront = new FrontPageModel($post);
        } else {
            $pageFront = new FrontPageModel(get_post($frontPageId));
        }
        return self::$pageFront = $pageFront;
    }
}
