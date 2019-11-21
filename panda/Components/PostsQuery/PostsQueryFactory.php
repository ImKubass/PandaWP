<?php

namespace Components\PostsQuery;

class PostsQueryFactory
{
    /** @return PostsQuery */
    public static function create($Count = PostsQuery::DEFAULT_COUNT)
    {
        return new PostsQuery($Count);
    }
}
