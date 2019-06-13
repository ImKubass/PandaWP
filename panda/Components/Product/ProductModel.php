<?php

namespace Components\Product;

use Utils\Util;
use Components\ProductTermBrand\ProductTermBrandModel;

class ProductModel extends \KT_WP_Post_Base_Model
{

    private $BrandModel;

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, ProductConfig::FORM_PREFIX);
        $this->getBrandModel();
    }


    //? --- Getry ------------------------------------------------------------

    public function getBrandName()
    {
        return $this->getBrandModel()->getName();
    }

    /** @return ProductTermBrandModel */
    public function getBrandModel()
    {
        if (Util::issetAndNotEmpty($this->BrandModel)) {
            return $this->BrandModel;
        } else {
            $BrandObject = $this->getTerms(PRODUCT_BRAND_KEY);
            if (Util::arrayIssetAndNotEmpty($BrandObject)) {
                $BrandObject = reset($BrandObject);
                return $this->BrandModel = new ProductTermBrandModel($BrandObject);
            }
        }
    }

    public function getBrandLogoSrc()
    {
        return $this->getBrandModel()->getParamsLogoSrc();
    }

    public function getBrandLogoSrc2x()
    {
        return $this->getBrandModel()->getParamsLogoSrc2x();
    }

    public function getBrandTitle()
    {
        return $this->getBrandModel()->getTitle();
    }

    public function getBrandLink()
    {
        return $url = $this->getBrandModel()->getPermalink();
    }


    public function getFilesAttached()
    {
        return $this->getGallery()->getFiles();
    }

    public function getFilesAttachedCount()
    {
        return count($this->getFilesAttached());
    }

    public function getGalleryPicturesFirstThree()
    {
        return array_slice($this->getFilesAttached(), 0, 3);
    }

    public function getGalleryPicturesHidden()
    {
        return array_slice($this->getFilesAttached(), 3);
    }

    public function getGalleryItemVisibleTemplateName()
    {
        return locate_template(COMPONENTS_PATH . "ProductGalleryItem/ProductGalleryItemVisible.php");
    }

    public function getGalleryItemHiddenTemplateName()
    {
        return locate_template(COMPONENTS_PATH . "ProductGalleryItem/ProductGalleryItemHidden.php");
    }

    //* --- Hlavní parametry
    //* --- Prefix: Params

    public function getParamsControlledPowerFrom()
    {
        return $this->getMetaValue(ProductConfig::PARAMS_CONTROLLED_POWER_FROM);
    }

    public function getParamsControlledPowerTo()
    {
        return $this->getMetaValue(ProductConfig::PARAMS_CONTROLLED_POWER_TO);
    }

    public function getParamsControlledPower()
    {
        $to = $this->getParamsControlledPowerTo();
        $from = $this->getParamsControlledPowerFrom();

        return $power = $from . " - " . $to;
    }

    public function getParamsWoodConsumption()
    {
        return $this->getMetaValue(ProductConfig::PARAMS_WOOD_CONSUMPTION);
    }

    public function getParamsConsumptionEfficiency()
    {
        return $this->getMetaValue(ProductConfig::PARAMS_CONSUMPTION_EFFICIENCY);
    }

    //* --- Cena
    //* --- Prefix: Price

    public function getPriceBasicPrice()
    {
        return $this->getMetaValue(ProductConfig::PRICE_BASIC_PRICE);
    }

    public function getPriceBasicPriceFancy()
    {
        return Util::fancyPrice($this->getPriceBasicPrice());
    }

    public function getPriceDiscountPrice()
    {
        return $this->getMetaValue(ProductConfig::PRICE_DISCOUNT_PRICE);
    }

    public function getPriceDiscountPriceFancy()
    {
        return Util::fancyPrice($this->getPriceDiscountPrice());
    }

    //* --- Technické parametry
    //* --- Prefix: TechnicalParameters

    public function getTechnicalParametersParam()
    {
        return $this->getMetaValue(ProductConfig::TECHNICAL_PARAMETERS_PARAM);
    }

    public function getTechnicalParametersValue()
    {
        return $this->getMetaValue(ProductConfig::TECHNICAL_PARAMETERS_VALUE);
    }

    public function getTechnicalParametersUnit()
    {
        return $this->getMetaValue(ProductConfig::TECHNICAL_PARAMETERS_UNIT);
    }

    /** @return array */
    public function getDynamicTechnicalParameters()
    {
        return $this->getMetaValue(ProductConfig::DYNAMIC_TECHNICAL_PARAMETERS_FIELD);
    }

    public function getDynamicTechnicalParametersInThreeArrays()
    {
        $Parameters = $this->getDynamicTechnicalParameters();
        $Rows = ceil(count($Parameters) / 3);
        return $Parameters = array_chunk($Parameters, $Rows);
    }

    //* --- Ostatní informace
    //* --- Prefix: OtherInfo

    public function getOtherInfoUrl()
    {
        return $this->getMetaValue(ProductConfig::OTHER_INFO_URL);
    }

    public function getOtherInfoVisible()
    {
        return $this->getMetaValue(ProductConfig::OTHER_INFO_VISIBLE);
    }


    //? --- Issety ------------------------------------------------------

    public function isBrand()
    {
        return is_object($this->BrandModel);
    }

    public function isGalleryPicturesFirstThree()
    {
        return Util::arrayIssetAndNotEmpty($this->getGalleryPicturesFirstThree());
    }

    public function isGalleryPicturesHidden()
    {
        return Util::arrayIssetAndNotEmpty($this->getGalleryPicturesHidden());
    }


    //* --- Hlavní parametry
    //* --- Prefix: Params

    public function isParamsControlledPowerFrom()
    {
        return Util::issetAndNotEmpty($this->getParamsControlledPowerFrom());
    }

    public function isParamsControlledPowerTo()
    {
        return Util::issetAndNotEmpty($this->getParamsControlledPowerTo());
    }

    public function isParamsWoodConsumption()
    {
        return Util::issetAndNotEmpty($this->getParamsWoodConsumption());
    }

    public function isParamsConsumptionEfficiency()
    {
        return Util::issetAndNotEmpty($this->getParamsConsumptionEfficiency());
    }

    public function isParamsPower()
    {
        return $this->isParamsControlledPowerTo() || $this->isParamsControlledPowerFrom();
    }

    public function isParams()
    {
        return $this->isParamsControlledPowerFrom() || $this->isParamsControlledPowerTo() || $this->isParamsWoodConsumption() || $this->isParamsConsumptionEfficiency();
    }

    //* --- Cena
    //* --- Prefix: Price

    public function isPriceBasicPrice()
    {
        return Util::issetAndNotEmpty($this->getPriceBasicPrice());
    }

    public function isPriceDiscountPrice()
    {
        return Util::issetAndNotEmpty($this->getPriceDiscountPrice());
    }


    //* --- Technické parametry
    //* --- Prefix: TechnicalParameters

    public function isTechnicalParametersParam()
    {
        return Util::issetAndNotEmpty($this->getTechnicalParametersParam());
    }

    public function isTechnicalParametersValue()
    {
        return Util::issetAndNotEmpty($this->getTechnicalParametersValue());
    }

    public function isTechnicalParametersUnit()
    {
        return Util::issetAndNotEmpty($this->getTechnicalParametersUnit());
    }

    public function isDynamicTechnicalParameters()
    {
        return Util::arrayIssetAndNotEmpty($this->getDynamicTechnicalParameters());
    }



    //* --- Ostatní informace
    //* --- Prefix: OtherInfo

    public function isOtherInfoUrl()
    {
        return Util::issetAndNotEmpty($this->getOtherInfoUrl());
    }

    public function isOtherInfoVisible()
    {
        return Util::issetAndNotEmpty($this->getOtherInfoVisible());
    }
}
