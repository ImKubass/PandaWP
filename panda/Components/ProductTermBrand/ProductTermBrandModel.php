<?php

namespace Components\ProductTermBrand;

use Utils\Image;
use Utils\Util;

class ProductTermBrandModel extends \KT_WP_Term_Base_Model
{
    public function __construct(\WP_Term $term)
    {
        parent::__construct($term);
    }

    //? --- Getry ------------------------------------------------------------

    public function getTitle()
    {
        return $this->getName();
    }

    public function getParamsLogoId()
    {
        return $this->getMetaValue(ProductTermBrandConfig::PARAMS_LOGO_ID);
    }

    public function getParamsLogoSrc()
    {
        return Image::getImageSrc($this->getParamsLogoId(), IMAGE_SIZE_180x42_no_crop);
    }

    public function getParamsLogoSrc2x()
    {
        return Image::getImageSrc($this->getParamsLogoId(), IMAGE_SIZE_360x84_no_crop) . " 2x";
    }

    public function getParamsPhotoId()
    {
        return $this->getMetaValue(ProductTermBrandConfig::PARAMS_PHOTO_ID);
    }

    public function getParamsPhotoSrc()
    {
        return Image::getImageSrc($this->getParamsPhotoId(), IMAGE_SIZE_420x300);
    }

    public function getParamsPhotoSrc2x()
    {
        return Image::getImageSrc($this->getParamsPhotoId(), IMAGE_SIZE_840x600);
    }

    public function getParamsThumbnailId()
    {
        return $this->getMetaValue(ProductTermBrandConfig::PARAMS_THUMBNAIL_ID);
    }

    public function getParamsThumbnailSrc()
    {
        return Image::getImageSrc($this->getParamsThumbnailId(), IMAGE_SIZE_140x160_no_crop);
    }

    public function getParamsThumbnailSrc2x()
    {
        return Image::getImageSrc($this->getParamsThumbnailId(), IMAGE_SIZE_280x320_no_crop);
    }

    public function getParamsOrder()
    {
        return $this->getMetaValue(ProductTermBrandConfig::PARAMS_ORDER);
    }


    //? --- Issety ------------------------------------------------------------

    public function isParamsLogoId()
    {
        return Util::issetAndNotEmpty($this->getParamsLogoId());
    }

    public function isParamsPhotoId()
    {
        return Util::issetAndNotEmpty($this->getParamsPhotoId());
    }

    public function isParamsThumbnailId()
    {
        return Util::issetAndNotEmpty($this->getParamsThumbnailId());
    }

    public function isParamsOrder()
    {
        return Util::issetAndNotEmpty($this->getParamsOrder());
    }
}
