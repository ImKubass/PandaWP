<?php

namespace Layouts\Contact;

use Layouts\Page\PageModel;
use Utils\uString;
use Utils\Util;

class ContactModel extends PageModel
{

    public function __construct(\WP_Post $post)
    {
        parent::__construct($post, ContactConfig::FORM_PREFIX);
        $this->setMetaPrefix(ContactConfig::FORM_PREFIX);
    }

    //? --- Getry ------------------------------------------------------------

    //* --- Sekce Zaměstnanci
    //* --- Prefix: EmployeesSection

    public function getEmployeesSectionTitle()
    {
        return $this->getMetaValue(ContactConfig::EMPLOYEES_SECTION_TITLE);
    }

    public function getEmployeesSectionTitleFancy()
    {
        return uString::wrapWithSpan($this->getEmployeesSectionTitle());
    }

    public function getEmployeesSectionTitleClean()
    {
        return uString::cleanStringFromSpecialCharacters($this->getEmployeesSectionTitle());
    }

    public function getEmployeesSectionDescription()
    {
        return $this->getMetaValue(ContactConfig::EMPLOYEES_SECTION_DESCRIPTION);
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
