<?php

namespace Components\PostQuery;

class PostQueryFactory
{
    /** @return PostQuery */
    public static function create($Count = PostQuery::DEFAULT_COUNT): PostQuery
    {
        return new PostQuery($Count);
    }

    /** @return PostRelatedQuery */
    public static function createRelated($Count = PostRelatedQuery::DEFAULT_COUNT)
    {
        return new PostRelatedQuery($Count);
    }
}
