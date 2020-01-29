<?php

namespace Components\Post;

use Components\SchemaGenerator\SchemaGenerator;
use Interfaces\Jsonable;

/**
 * Class PostModel
 * @package Components\Post
 */
class PostModel extends \KT_WP_Post_Base_Model implements Jsonable
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, PostConfig::FORM_PREFIX);
    }

    public function tryGetJsonLdData()
    {
        $data = [
            "@context" => "http://schema.org",
            "@type" => "NewsArticle",
            "mainEntityOfPage" => [
                "@type" => "WebPage",
            ],
            "headline" => $this->getTitle(),
            "articleBody" => $this->getExcerpt(),
            "author" => $this->getAuthor()->getDisplayName(),
            "url" => $this->getPermalink(),
        ];
        SchemaGenerator::insertThumbnail($data, $this);
        SchemaGenerator::insertDates($data, $this);
        SchemaGenerator::insertPublisher($data, $this);
        return $data;
    }
}
