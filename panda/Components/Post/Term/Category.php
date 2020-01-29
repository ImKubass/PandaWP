<?php


namespace Components\Post\Term;

use Components\Post\Post;

/**
 * Class Category
 * @package Components\Post\Term
 */
class Category
{
    const KEY    = "category";
    const PREFIX = Post::KEY . "-term-" . self::KEY;
}
