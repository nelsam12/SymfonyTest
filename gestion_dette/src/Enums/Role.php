<?php
namespace App\Enums;

enum Role : string{
    case ADMIN = 'ROLE_ADMIN';
    case CLIENT = 'ROLE_CLIENT';
    case BOUTIQUIER = 'ROLE_BOUTIQUIER';

    public static function getValue(Role $role) : string{
        return $role->value;
    }
    public static function fromValue(string $value) :?Role{
        return self::tryFrom($value);
    }
}

