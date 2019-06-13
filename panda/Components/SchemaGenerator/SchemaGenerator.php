<?php
namespace Components\SchemaGenerator;

use Components\PageTheme\PageThemeFactory;
use Components\Product\ProductPresenter;
use Utils\Util;


class SchemaGenerator
{
    private static $values = [];
    private static $persons = [];
    private static $services = [];
    private static $reviews;
    private static $items = [];

    public static function addSite()
    {
        $ktWpInfo = new \KT_WP_Info();
        $url = get_home_url();
        self::addCustom([
            "@context" => "http://schema.org",
            "@type" => "WebSite",
            "name" => $ktWpInfo->getName(),
            "url" => $url,
            "description" => $ktWpInfo->getDescription(),
        ]);
    }

    public static function addOrganization()
    {
        $Theme = PageThemeFactory::create();
        if ($Theme->isContactCompanyName()) {

            if ($Theme->isContactLogoId()) {
                $logoImage = $Theme->getContactLogoSrc();
            } else {
                $logoImage = Util::imageGetUrlFromTheme("favicon/android-chrome-192x192.png");
            }
            $url = get_home_url();

            $values = [
                "@context" => "http://schema.org",
                "@type" => "Organization",
                "logo" => $logoImage,
                "name" => $Theme->getContactCompanyName(),
                "description" => $Theme->getContactDescription(),
                "email" => $Theme->getContactEmail(),
                "url" => $url,
                "telephone" => $Theme->getContactPhoneClean(),
                "taxID" => $Theme->getContactDic(),
            ];
            if ($Theme->isSocialsSameAsData()) {
                $values["sameAs"] = $Theme->getSocialsSameAsData();
            }

            if ($Theme->isContactAdress() && (is_front_page())) {
                $values["address"] = [
                    "@type" => "PostalAddress",
                    "streetAddress" => $Theme->getContactStreet(),
                    "postalCode" => $Theme->getContactZip(),
                    "addressLocality" => $Theme->getContactCity(),
                    "addressCountry" => [
                        "@type" => "Country",
                        "name" => "CZ"
                    ],
                ];
            }
            self::addCustom($values);
        }
    }

    public static function addArchive($key)
    {
        $postTypeObject = get_post_type_object($key);
        $url = get_post_type_archive_link($key);
        self::addCustom([
            "@context" => "http://schema.org",
            "@type" => "WebPage",
            "url" => $url,
            "name" => $postTypeObject->labels->name,
            "potentialAction" => [
                "@type" => "SearchAction",
                "target" => "$url/?search={query}",
                "query-input" => "required name=query"
            ]
        ]);
    }

    public static function addTaxonomy(\KT_WP_Term_Base_Model $model)
    {
        $url = $model->getPermalink();
        self::addCustom([
            "@context" => "http://schema.org",
            "@type" => "WebPage",
            "url" => $url,
            "name" => $model->getName(),
            "description" => $model->getDescription(),
            "potentialAction" => [
                "@type" => "SearchAction",
                "target" => "$url/?search={query}",
                "query-input" => "required name=query"
            ]
        ]);
    }

    public static function addProduct(ProductPresenter $Product)
    {
        $ProductModel = $Product->getModel();
        $url = $ProductModel->getPermalink();
        $Theme = PageThemeFactory::create();

        if ($Theme->isContactLogoId()) {
            $logoImage = $Theme->getContactLogoSrc();
        } else {
            $logoImage = Util::imageGetUrlFromTheme("favicon/android-chrome-192x192.png");
        }
        $Pageurl = get_home_url();

        self::addCustom([
            "@context" => "http://schema.org",
            "@type" => "Product",
            "image" => $Product->getThumbnailSrc(),
            "url" => $url,
            "name" => $Product->title(),
            "brand" => [
                "@type" => "Organization",
                "logo" => $logoImage,
                "name" => $Theme->getContactCompanyName(),
                "description" => $Theme->getContactDescription(),
                "email" => $Theme->getContactEmail(),
                "url" => $Pageurl,
                "telephone" => $Theme->getContactPhoneClean(),
                "taxID" => $Theme->getContactDic(),
                "sameAs" =>  $Theme->getSocialsSameAsData(),
            ],
            "offers" => [
                "@type" => "Offer",
                "priceCurrency" => "CZK",
                "price" => $ProductModel->getPriceBasicPrice(),
                "seller" => [
                    "@type" => "Organization",
                    "name" => $Theme->getContactCompanyName(),
                ]
            ]
        ]);
    }

    public static function addComment(\WP_Comment $comment)
    {

        $commentContent = strip_tags($comment->comment_content);
        $commentContent = str_replace('"', '', $commentContent);
        self::addCustom([
            "@context" => "http://schema.org",
            "@type" => "UserComments",
            "@id" => $comment->comment_ID,
            "commentTime" => mysql2date(\DateTime::ISO8601, $comment->comment_date_gmt),
            "commentText" => $commentContent,
            "creator" => [
                "@type" => "Thing",
                "name" => $comment->comment_author,
            ]
        ]);
    }

    public static function addCustom($value)
    {
        if (Util::issetAndNotEmpty($value)) {
            self::$values[] = $value;
        }
    }

    public static function addItem($item)
    {
        if (Util::arrayIssetAndNotEmpty($item)) {
            self::$items[] = $item;
        }
    }

    public static function addPerson($person)
    {
        if (Util::arrayIssetAndNotEmpty($person)) {
            self::$persons[] = $person;
        }
    }

    public static function addService($service)
    {
        if (Util::arrayIssetAndNotEmpty($service)) {
            self::$services[] = $service;
        }
    }

    public static function addReview($review)
    {
        if (Util::arrayIssetAndNotEmpty($review)) {
            self::$reviews[] = $review;
        }
    }

    public static function insertThumbnail(array &$data, \KT_WP_Post_Base_Model $model)
    {
        if ($model->hasThumbnail()) {
            $thumbnailSrc = Util::getImageSrc($model->getThumbnailId, KT_WP_IMAGE_SIZE_THUBNAIL);
            if (Util::arrayIssetAndNotEmpty($thumbnailSrc)) {
                $data["image"] = [
                    "@type" => "ImageObject",
                    "url" => $thumbnailSrc[0],
                    "width" => 300,
                    "height" => 225,
                ];
            }
        }
        return $data;
    }

    public static function insertDescription(array &$data, \KT_WP_Post_Base_Model $model)
    {
        $description = $model->getExcerpt(false, 10);
        if (Util::issetAndNotEmpty($description)) {
            $data["description"] = $description;
        }
        return $data;
    }

    public static function insertDates(array &$data, \KT_WP_Post_Base_Model $model)
    {
        $publishDate = $model->getPublishDate(\DateTime::ISO8601);
        if (Util::issetAndNotEmpty($publishDate)) {
            $data["datePublished"] = $publishDate;
        }
        $modifiedDate = $model->getModifiedDate(\DateTime::ISO8601);
        if (Util::issetAndNotEmpty($modifiedDate)) {
            $data["dateModified"] = $modifiedDate;
        }
        return $data;
    }

    public static function insertPublisher(array &$data, \KT_WP_Post_Base_Model $model)
    {
        $Theme = PageThemeFactory::create();
        if ($Theme->isContactCompanyName()) {
            if ($Theme->isContactLogoId()) {
                $logoImage = $Theme->getContactLogoSrc();
            } else {
                $logoImage = Util::imageGetUrlFromTheme("favicon/android-chrome-192x192.png");
            }

            $data["publisher"] = [
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
        return $data;
    }

    public static function render()
    {
        if (Util::arrayIssetAndNotEmpty(self::$items)) {
            foreach (self::$items as $index => $item) {
                self::$items[$index]["position"] = $index + 1;
            }
            self::addCustom([
                "@context" => "http://schema.org",
                "@type" => "ItemList",
                "itemListElement" => self::$items,
            ]);
        }
        $values = self::$values;
        $valuesCount = count($values);
        if ($valuesCount <= 0) {
            return;
        }
        echo "\n<script type=\"application/ld+json\">\n";
        if ($valuesCount === 1) {
            echo self::getVisual(reset($values));
        } else {
            echo "[\n";
            echo implode(",\n", array_map(function ($value) {
                return self::getVisual($value);
            }, array_filter($values, function ($value) {
                return Util::arrayIssetAndNotEmpty($value);
            })));
            echo "\n]";
        }
        echo "\n</script>\n";
    }

    public static function getVisual(array $data = null, $depth = 0)
    {
        if (!empty($data)) {
            $hasNumericKeys = count(array_filter(array_keys($data), "is_numeric")) > 0;
            $output = Util::getTabsIndent($depth, $hasNumericKeys ? "[" : "{", false, true);
            $values = [];
            foreach ($data as $key => $value) {
                if (isset($value)) {
                    $value = is_array($value) ? self::getVisual($value, $depth + 1) : "\"$value\"";
                    if (is_numeric($key)) {
                        $values[] = Util::getTabsIndent($depth, "$value");
                    } else {
                        $values[] = Util::getTabsIndent($depth + 1, "\"$key\": $value");
                    }
                }
            }
            $output .= implode(",\n", $values);
            $output .= Util::getTabsIndent($depth, $hasNumericKeys ? "]" : "}", true);
            return $output;
        }
    }
}
