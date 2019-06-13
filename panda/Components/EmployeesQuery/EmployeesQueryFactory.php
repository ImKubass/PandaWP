<?php

namespace Components\EmployeesQuery;

class EmployeesQueryFactory
{
    /** @return EmployeesQuery */
    public static function create()
    {
        return new EmployeesQuery();
    }
}
