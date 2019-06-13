<?php

namespace Components\Employee;

class EmployeeConfig implements \KT_Configable
{
    const FORM_PREFIX = "employee";

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

    // --- parametry ---------------------------

    const PARAMS_FIELDSET = self::FORM_PREFIX . "-params";
    const PARAMS_JOB = self::PARAMS_FIELDSET . "-job";
    const PARAMS_PHONE = self::PARAMS_FIELDSET . "-phone";
    const PARAMS_EMAIL = self::PARAMS_FIELDSET . "-email";
    const PARAMS_GMAIL = self::PARAMS_FIELDSET . "-gmail";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Parametry", "RLG_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_JOB, __("Pracovní pozice:", "RLG_DOMAIN"));
        $fieldset->addText(self::PARAMS_PHONE, __("Telefon:", "RLG_DOMAIN"));
        $fieldset->addText(self::PARAMS_EMAIL, __("Email:", "RLG_DOMAIN"));
        $fieldset->addText(self::PARAMS_GMAIL, __("Gmail:", "RLG_DOMAIN"));

        return $fieldset;
    }
}