<?php

namespace Components\Post;

class PostFactory
{
    /**
     * @return PostModel
     */
    public static function create()
    {
        global $post;
        return new PostModel($post);
    }
}
