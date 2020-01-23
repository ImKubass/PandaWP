<?php

namespace Components\EmployeeQuery;

class EmployeeQueryFactory
{
    /** @return EmployeeQuery */
    public static function create()
    {
        return new EmployeeQuery();
    }
}
