<?php

namespace Components\PostQuery;

/**
 * Class PostQueryFactory
 * @package Components\PostQuery
 */
class PostQueryFactory
{
    public static function create($Count = PostQuery::DEFAULT_COUNT): PostQuery
    {
        return new PostQuery($Count);
    }

    public static function createRelated($Count = PostRelatedQuery::DEFAULT_COUNT)
    {
        return new PostRelatedQuery($Count);
    }
}
