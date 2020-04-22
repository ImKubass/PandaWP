<?php

namespace Components\Post;

use Utils\Util;
use Utils\Image;
use Components\SchemaGenerator\SchemaGenerator;
use Components\ThemeSettings\ThemeSettingsFactory;

/**
 * Class PostModel
 * @package Components\Post
 */
class PostModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, PostConfig::FORM_PREFIX);
    }


    public function addItemToSchema()
    {
        SchemaGenerator::addItem([
            "@type" => "ListItem",
            "url" => $this->getPermalink(),
            "name" => $this->getTitle(),
        ]);
    }

    public function addPostDetailToSchema()
    {
        $Data = [
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

        // Add Thumbnail
        if ($this->hasThumbnail()) {
            $ThumbnailSrc = Image::getImageSrc($this->getThumbnailId(), KT_WP_META_KEY_THUMBNAIL_ID);
            if (Util::issetAndNotEmpty($ThumbnailSrc)) {
                $Data["image"] = [
                    "@type" => "ImageObject",
                    "url" => $ThumbnailSrc,
                    "width" => 150,
                    "height" => 150,
                ];
            }
        }

        // Add Desctiption
        $Description = $this->getExcerpt(false, 10);
        if (Util::issetAndNotEmpty($Description)) {
            $Data["description"] = $Description;
        }


        // Add Dates
        $publishDate = $this->getPublishDate(\DateTime::ISO8601);
        if (Util::issetAndNotEmpty($publishDate)) {
            $Data["datePublished"] = $publishDate;
        }
        $modifiedDate = $this->getModifiedDate(\DateTime::ISO8601);
        if (Util::issetAndNotEmpty($modifiedDate)) {
            $Data["dateModified"] = $modifiedDate;
        }

        // Add Publisher
        $Theme = ThemeSettingsFactory::create();
        if ($Theme->isContactCompanyName()) {
            if ($Theme->isContactLogoId()) {
                $logoImage = $Theme->getContactLogoSrc();
            } else {
                $logoImage = Image::imageGetUrlFromTheme("favicon/android-chrome-192x192.png");
            }

            $Data["publisher"] = [
                "@type" => "Organization",
                "name" => $Theme->getContactCompanyName(),
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => "$logoImage",
                    "width" => 170,
                    "height" => 60
                ]
            ];
        }

        SchemaGenerator::addCustom($Data);
    }
}
