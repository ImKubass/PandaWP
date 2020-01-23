<?php

namespace Components\EmployeeQuery;

use Components\Employee\Employee;
use Presenters\QueryBase;

class EmployeeQuery extends QueryBase
{

    public function __construct()
    {
        parent::__construct();
        $this->setPostType(Employee::KEY);
        $this->setComponent(Employee::class);
        $this->setTemplate(Employee::TEMPLATE);
        $this->initArgs();
    }

    // Custom Args for Query
    public function initArgs()
    {
        $Args = [
            "post_type" => $this->getPostType(),
            "post_status" => "publish",
            "posts_per_page" => $this->getMaxCount(),
            "orderby" => "date",
            "order" => \KT_Repository::ORDER_DESC,
        ];

        return $this->setArgs($Args);
    }
}
