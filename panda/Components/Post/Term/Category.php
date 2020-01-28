<?php


namespace Components\Post\Term;

use Components\Post\Post;

class Category
{
    const KEY    = "category";
    const PREFIX = Post::KEY . "-term-" . self::KEY;
}
