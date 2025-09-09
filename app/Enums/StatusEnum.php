<?php

namespace App\Enums;

enum StatusEnum : string
{
    //Status
    const ACTIVE   = "active";
    const INACTIVE = "inactive";

    //Role
    const ADMIN       = "admin";
    const SUPER_ADMIN = "super-admin";
    const EMPLOYEE    = "employee";

    // Reward
    const ONTIME          = "ontime";
    const FULL_ATTENDANCE = "full_attendance";
    const EXTRA           = "extra";

    // Leave Type
    const CASUAL = "casual";
    const SICK   = "sick";
    const ANNUAL = "annual";
}
