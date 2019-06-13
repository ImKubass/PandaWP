<?php

namespace Components\Employee;

use Utils\Util;
use Components\Employee\EmployeeConfig;
use Components\SchemaGenerator\SchemaGenerator;

class EmployeeModel extends \KT_WP_Post_Base_Model
{
    public function __construct(\WP_Post $post)
    {
        parent::__construct($post, EmployeeConfig::FORM_PREFIX);
    }

    public function getThumbnailSrc()
    {
        return Util::getImageSrc($this->getThumbnailId(), KT_WP_IMAGE_SIZE_THUBNAIL);
    }

    public function getThumbnailSrc2x()
    {
        return Util::getImageSrc($this->getThumbnailId(), IMAGE_SIZE_300x300);
    }


    // --- getry & setry ------------------------


    public function getParamJob()
    {
        return $this->getMetaValue(EmployeeConfig::PARAMS_JOB);
    }

    public function getParamPhone()
    {
        return $this->getMetaValue(EmployeeConfig::PARAMS_PHONE);
    }

    public function getParamPhoneClean()
    {
        return Util::clearPhoneNumber($this->getParamPhone());
    }

    public function getParamPhoneFancy()
    {
        return Util::phoneNumberFormat($this->getParamPhone());
    }

    public function getParamEmail()
    {
        return $this->getMetaValue(EmployeeConfig::PARAMS_EMAIL);
    }

    public function getParamGmail()
    {
        return $this->getMetaValue(EmployeeConfig::PARAMS_GMAIL);
    }

    public function getContentClean()
    {
        return strip_tags($this->getContent(), "<a><strong><b><i>");
    }

    // --- veřejné metody ------------------------

    public function isThumbnailSrc()
    {
        return Util::issetAndNotEmpty($this->getThumbnailSrc());
    }

    public function isParamJob()
    {
        return Util::issetAndNotEmpty($this->getParamJob());
    }

    public function isParamPhone()
    {
        return Util::issetAndNotEmpty($this->getParamPhone());
    }

    public function isParamEmail()
    {
        return Util::issetAndNotEmpty($this->getParamEmail());
    }

    public function isParamGmail()
    {
        return Util::issetAndNotEmpty($this->getParamGmail());
    }

    // --- Schema ------------------------

    public function tryAddPersonJsonLdData()
    {
        SchemaGenerator::addPerson([
            "@type" => "Person",
            "name" => $this->getTitle(),
            "jobTitle" => $this->getParamJob(),
            "email" => $this->getParamEmail(),
            "telephone" => $this->getParamPhone(),
        ]);
    }
}
