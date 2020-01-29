<?php

namespace Components\Post;

/**
 * Class PostFactory
 * @package Components\Post
 */
class PostFactory
{
    public static function create(): PostModel
    {
        global $post;
        return new PostModel($post);
    }
}
