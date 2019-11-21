<?php

namespace Components\PostsQuery;

use Presenters\QueryBase;
use Utils\Util;

class PostsQuery extends QueryBase
{

    public function __construct()
    {
        parent::__construct();
    }

    private function initPosts()
    {

        $args = [
            "post_type" => KT_WP_POST_KEY,
            "post_status" => "publish",
            "posts_per_page" => $this->getMaxCount(),
            "orderby" => "date",
            "order" => \KT_Repository::ORDER_DESC,
        ];
        // except himself
        if (is_single()) {
            $args["post__not_in"] = [get_the_ID()];
        }

        $query = new \WP_Query();
        $posts = $query->query($args);
        if (Util::arrayIssetAndNotEmpty($posts)) {
            $this->posts = $posts;
            $this->postsCount = count($posts);
        } else {
            $this->posts = [];
            $this->postsCount = 0;
        }
    }
}
