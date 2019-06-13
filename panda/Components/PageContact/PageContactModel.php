<?php

namespace Components\PageContact;

use Components\Page\PageModel;
use Utils\Util;

class PageContactModel extends PageModel
{

    public function __construct(\WP_Post $post)
    {
        parent::__construct($post, PageContactConfig::FORM_PREFIX);
        $this->setMetaPrefix(PageContactConfig::FORM_PREFIX);
    }

    //? --- Getry ------------------------------------------------------------

    //* --- Sekce Zaměstnanci
    //* --- Prefix: EmployeesSection

    public function getEmployeesSectionTitle()
    {
        return $this->getMetaValue(PageContactConfig::EMPLOYEES_SECTION_TITLE);
    }

    public function getEmployeesSectionTitleFancy()
    {
        return Util::wrapWithSpan($this->getEmployeesSectionTitle());
    }

    public function getEmployeesSectionTitleClean()
    {
        return Util::cleanStringFromSpecialCharacters($this->getEmployeesSectionTitle());
    }

    public function getEmployeesSectionDescription()
    {
        return $this->getMetaValue(PageContactConfig::EMPLOYEES_SECTION_DESCRIPTION);
    }



    //? --- Issety ------------------------------------------------------------------------

    //* --- Sekce Zaměstnanci
    //* --- Prefix: EmployeesSection

    public function isEmployeesSectionTitle()
    {
        return Util::issetAndNotEmpty($this->getEmployeesSectionTitle());
    }

    public function isEmployeesSectionDescription()
    {
        return Util::issetAndNotEmpty($this->getEmployeesSectionDescription());
    }
}
