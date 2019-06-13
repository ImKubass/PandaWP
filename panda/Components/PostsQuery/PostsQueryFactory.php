<?php

namespace Components\PostsQuery;

class PostsQueryFactory
{
    /** @return PostsQuery */
    public static function create()
    {
        return new PostsQuery();
    }
}