<?php

namespace App\Enums;

enum RoleEnum: string
{
    case SUPER_ADMIN = "Super-Admin";
    case ADMIN = "admin";
    case USER = "user";
}
