<?php

namespace Layouts\Page;

class PageFactory
{

    /** @return PageModel */
    public static function create()
    {
        global $post;
        return new PageModel($post);
    }
}
