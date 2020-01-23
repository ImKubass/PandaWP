<?php

namespace Layouts\PageContact;

class PageContactFactory
{

    /** @return PageContactModel */
    public static function create()
    {
        global $post;
        return new PageContactModel($post);
    }
}