<?php

namespace Components\Employee;

use Interfaces\Configable;

class EmployeeConfig implements Configable
{
    const FORM_PREFIX = Employee::KEY;

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

    public static function registerMetaboxes()
    {
        registerMetabox(self::class, Employee::KEY);
    }

    // --- parametry ---------------------------

    const PARAMS_FIELDSET = self::FORM_PREFIX . "-params";
    const PARAMS_JOB      = self::PARAMS_FIELDSET . "-job";
    const PARAMS_PHONE    = self::PARAMS_FIELDSET . "-phone";
    const PARAMS_EMAIL    = self::PARAMS_FIELDSET . "-email";
    const PARAMS_GMAIL    = self::PARAMS_FIELDSET . "-gmail";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Parametry", ADMIN_DOMAIN));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_JOB, __("Pracovní pozice:", ADMIN_DOMAIN));
        $fieldset->addText(self::PARAMS_PHONE, __("Telefon:", ADMIN_DOMAIN));
        $fieldset->addText(self::PARAMS_EMAIL, __("Email:", ADMIN_DOMAIN));
        $fieldset->addTrumbowygTextarea(self::PARAMS_GMAIL, __("Gmail:", ADMIN_DOMAIN));

        return $fieldset;
    }
}
