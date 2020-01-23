<?php

namespace Components\PostQuery;

class PostQueryFactory
{
    /** @return PostQuery */
    public static function create($Count = PostQuery::DEFAULT_COUNT)
    {
        return new PostQuery($Count);
    }
}
