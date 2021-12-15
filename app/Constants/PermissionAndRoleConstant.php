<?php

namespace App\Constants;

class PermissionAndRoleConstant {
    /**
     * permissions
     */
    public const PERMISSION_SETTING = 'permission_setting';
    public const PERMISSION_INVOICE = 'permission_invoice';

    /**
     * roles
     */
    public const ROLE_ADMIN = 'Admin';
    public const ROLE_DOCTOR = 'Doctor';
    public const ROLE_MEMBER = 'Member';

    public static function GetAllPermissions():array {
        return [
            self::PERMISSION_SETTING,
            self::PERMISSION_INVOICE
        ];
    }

    public static function GetAllPermissionAndRole():array {
        return [
            self::ROLE_ADMIN => [self::PERMISSION_SETTING, self::PERMISSION_INVOICE],
            self::ROLE_DOCTOR => [self::PERMISSION_SETTING, self::PERMISSION_INVOICE],
            self::ROLE_MEMBER => [self::PERMISSION_INVOICE],
        ];
    }
}
