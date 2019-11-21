<?php

namespace Components\EmployeesQuery;

use Presenters\QueryBase;

class EmployeesQuery extends QueryBase
{

    public function __construct()
    {
        parent::__construct();
        $this->setPostType(EMPLOYEE_KEY);
    }
}
