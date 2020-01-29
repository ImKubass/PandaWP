<?php

namespace Layouts\Page;

/**
 * Class PageFactory
 * @package Layouts\Page
 */
class PageFactory
{
    public static function create(): PageModel
    {
        global $post;
        return new PageModel($post);
    }
}
