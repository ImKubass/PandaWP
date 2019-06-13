<?php

namespace Components\Post;

class PostFactory
{
    /**
     * @return PostPresenter
     */
    public static function create()
    {
        global $post;
        return new PostPresenter(new PostModel($post));
    }
}
