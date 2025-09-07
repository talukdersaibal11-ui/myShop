<?php

namespace App\Enums;

enum StatusEnum : string
{
      //Status
    const ACTIVE   = "active";
    const INACTIVE = "inactive";

      //Role
    const ADMIN       = 'admin';
    const SUPER_ADMIN = 'super-admin';
    const EMPLOYEE    = 'employee';
}
