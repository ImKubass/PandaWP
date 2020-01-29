<?php

namespace Layouts\Blog;

use Layouts\Page\PageModel;

/**
 * Class BlogFactory
 * @package Layouts\Blog
 */
class BlogFactory
{

    private static $PageModel;

    public static function create(): PageModel
    {
        global $post;
        $PostsPageId = get_option(KT_WP_OPTION_KEY_POSTS_PAGE);

        if (isset($post) && $post->ID == $PostsPageId) {
            $PageModel = new PageModel($post);
        } else {
            $PageModel = new PageModel(get_post($PostsPageId));
        }

        return self::$PageModel = $PageModel;
    }
}
