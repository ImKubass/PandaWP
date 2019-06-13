<?php

namespace Components\Product;

use Utils\Util;

class ProductPresenter extends \KT_WP_Post_Base_Presenter
{
    private $ThumbnailId;

    function __construct(ProductModel $model)
    {
        parent::__construct($model);
        $this->ThumbnailId = $this->getModel()->getThumbnailId();
    }

    // --- getry & setry ------------------------------

    /** @return ProductModel */
    public function getModel()
    {
        return parent::getModel();
    }


    // --- veřejné metody ------------------------------

    public function title()
    {
        return $this->getModel()->getTitle();
    }

    public function permaLink()
    {
        return $this->getModel()->getPermalink();
    }

    public function content()
    {
        return $this->getModel()->getContent();
    }

    public function priceFancy()
    {
        return Util::fancyPrice($this->getModel()->getPricePrice());
    }

    public function getThumbnailSrc()
    {
        return Util::getImageSrc($this->ThumbnailId, IMAGE_SIZE_203x203_NO_CROP);
    }

    public function getThumbnailSrc2x()
    {
        return Util::getImageSrc($this->ThumbnailId, IMAGE_SIZE_406x406_NO_CROP) . "2x";
    }

    public function getGallerySrc()
    {
        return Util::getImageSrc($this->ThumbnailId, IMAGE_SIZE_410x410_NO_CROP);
    }

    public function getGallerySrc2x()
    {
        return Util::getImageSrc($this->ThumbnailId, IMAGE_SIZE_820x820_NO_CROP) . "2x";
    }

    public function getPreviewSrc()
    {
        return Util::getImageSrc($this->ThumbnailId, IMAGE_SIZE_1920xauto);
    }


    //? --- Issety ------------------------------------------------------------

    public function isThumbnail()
    {
        return $this->getModel()->hasThumbnail();
    }


    //* --- Parametry
    //* --- Prefix: Params
}
