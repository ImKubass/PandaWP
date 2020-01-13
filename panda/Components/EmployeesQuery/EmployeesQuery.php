<?php

namespace Components\EmployeesQuery;

use Presenters\QueryBase;

class EmployeesQuery extends QueryBase
{

    public function __construct()
    {
        parent::__construct();
        $this->setPostType(EMPLOYEE_KEY);
        $this->setComponentLoopName(EMPLOYEE_LOOP);
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
