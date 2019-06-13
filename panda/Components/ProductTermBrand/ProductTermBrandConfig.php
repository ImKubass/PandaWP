<?php 

namespace Components\ProductTermBrand;

class ProductTermBrandConfig implements \KT_Configable
{
    const FORM_PREFIX = "product-term-brand";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }


    // --- Parametry ---------------------------

    const PARAMS_FIELDSET = self::FORM_PREFIX . "-params";
    const PARAMS_LOGO_ID = self::PARAMS_FIELDSET . "-logo-id";
    const PARAMS_PHOTO_ID = self::PARAMS_FIELDSET . "-photo-id";
    const PARAMS_THUMBNAIL_ID = self::PARAMS_FIELDSET . "-thumbnail-id";
    const PARAMS_ORDER = self::PARAMS_FIELDSET . "-order";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Parametry", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addMedia(self::PARAMS_LOGO_ID, __("Logo:", "RLG_DOMAIN"));
        $fieldset->addMedia(self::PARAMS_PHOTO_ID, __("Ilustrativní obrázek:", "RLG_DOMAIN"));
        $fieldset->addMedia(self::PARAMS_THUMBNAIL_ID, __("Náhledový obrázek:", "RLG_DOMAIN"));
        $fieldset->addNumeric(self::PARAMS_ORDER, __("Pořadí:", "RLG_DOMAIN"));

        return $fieldset;
    }
}