<?php

namespace Components\Product;

class ProductConfig implements \KT_Configable
{
    const FORM_PREFIX = "rlg-product";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::PRICE_FIELDSET => self::getPriceFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::DYNAMIC_TECHNICAL_PARAMETERS_FIELDSET => self::getDynamicTechnicalParametersFieldset(),
            self::OTHER_INFO_FIELDSET => self::getOtherInfoFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::TECHNICAL_PARAMETERS_FIELDSET => self::getTechnicalParametersFieldset(),
        ];
    }

    // --- Hlavní parametry ---------------------------

    const PARAMS_FIELDSET = self::FORM_PREFIX . "-params";
    const PARAMS_CONTROLLED_POWER_FROM = self::PARAMS_FIELDSET . "-controlled-power-from";
    const PARAMS_CONTROLLED_POWER_TO = self::PARAMS_FIELDSET . "-controlled-power-to";
    const PARAMS_WOOD_CONSUMPTION = self::PARAMS_FIELDSET . "-wood-consumption";
    const PARAMS_CONSUMPTION_EFFICIENCY = self::PARAMS_FIELDSET . "-wood-efficiency";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Hlavní parametry", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_CONTROLLED_POWER_FROM, __("Regulovaný výkon od:", "RLG_DOMAIN"));
        $fieldset->addText(self::PARAMS_CONTROLLED_POWER_TO, __("Regulovaný výkon do:", "RLG_DOMAIN"));
        $fieldset->addText(self::PARAMS_WOOD_CONSUMPTION, __("Spotřeba dřeva :", "RLG_DOMAIN"));
        $fieldset->addText(self::PARAMS_CONSUMPTION_EFFICIENCY, __("Účinnost spalování:", "RLG_DOMAIN"));

        return $fieldset;
    }

    // --- Cena ---------------------------

    const PRICE_FIELDSET = self::FORM_PREFIX . "-price";
    const PRICE_BASIC_PRICE = self::PRICE_FIELDSET . "-basic-price";
    const PRICE_DISCOUNT_PRICE = self::PRICE_FIELDSET . "-discount-price";


    public static function getPriceFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PRICE_FIELDSET, __("Cena", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::PRICE_FIELDSET);

        $fieldset->addNumeric(self::PRICE_BASIC_PRICE, __("Základní cena:", "RLG_DOMAIN"));
        $fieldset->addNumeric(self::PRICE_DISCOUNT_PRICE, __("Cena po slevě:", "RLG_DOMAIN"));

        return $fieldset;
    }

    // --- Ostatní informace ---------------------------

    const TECHNICAL_PARAMETERS_FIELDSET = self::FORM_PREFIX . "-technical-parameters";
    const TECHNICAL_PARAMETERS_PARAM = self::TECHNICAL_PARAMETERS_FIELDSET . "-param";
    const TECHNICAL_PARAMETERS_VALUE = self::TECHNICAL_PARAMETERS_FIELDSET . "-value";
    const TECHNICAL_PARAMETERS_UNIT = self::TECHNICAL_PARAMETERS_FIELDSET . "-unit";


    public static function getTechnicalParametersFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::TECHNICAL_PARAMETERS_FIELDSET, __("Ostatní informace", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::TECHNICAL_PARAMETERS_FIELDSET);

        $fieldset->addText(self::TECHNICAL_PARAMETERS_PARAM, __("Parametr:", "RLG_DOMAIN"));
        $fieldset->addText(self::TECHNICAL_PARAMETERS_VALUE, __("Hodnota:", "RLG_DOMAIN"));
        $fieldset->addText(self::TECHNICAL_PARAMETERS_UNIT, __("Jednotka:", "RLG_DOMAIN"));

        return $fieldset;
    }

    const DYNAMIC_TECHNICAL_PARAMETERS_FIELDSET = self::FORM_PREFIX . "-dynamic-technical-parameters";
    const DYNAMIC_TECHNICAL_PARAMETERS_FIELD = self::DYNAMIC_TECHNICAL_PARAMETERS_FIELDSET . "-field";

    public static function getDynamicTechnicalParametersFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::DYNAMIC_TECHNICAL_PARAMETERS_FIELDSET, __("Ostatní informace", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::DYNAMIC_TECHNICAL_PARAMETERS_FIELDSET);

        $fieldset->addFieldset(self::DYNAMIC_TECHNICAL_PARAMETERS_FIELD, __("Ostatní informace", "ELV_DOMAIN"), [self::class, self::TECHNICAL_PARAMETERS_FIELDSET]);

        return $fieldset;
    }

    // --- Ostatní informace ---------------------------

    const OTHER_INFO_FIELDSET = self::FORM_PREFIX . "-other-info";
    const OTHER_INFO_URL = self::OTHER_INFO_FIELDSET . "-url";
    const OTHER_INFO_VISIBLE = self::OTHER_INFO_FIELDSET . "-visible";


    public static function getOtherInfoFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::OTHER_INFO_FIELDSET, __("Ostatní informace", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::OTHER_INFO_FIELDSET);

        $fieldset->addText(self::OTHER_INFO_URL, __("Základní cena:", "RLG_DOMAIN"));
        $fieldset->addSwitch(self::OTHER_INFO_VISIBLE, __("Cena po slevě:", "RLG_DOMAIN"));

        return $fieldset;
    }
}
