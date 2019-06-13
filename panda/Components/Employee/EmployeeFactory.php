<?php

namespace Components\Employee;

class EmployeeFactory
{
    /** @return EmployeeModel */
    public static function create()
    {
        global $post;
        return new EmployeeModel($post);
    }
}