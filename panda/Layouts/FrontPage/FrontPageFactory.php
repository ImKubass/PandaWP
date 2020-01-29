<?php

namespace Layouts\FrontPage;

/**
 * Class FrontPageFactory
 * @package Layouts\FrontPage
 */
class FrontPageFactory
{
    private static $pageFront = null;

    public static function create(): FrontPageModel
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
