<?php

namespace App\Enums;

enum RoleEnum: int
{
    case USER = 1;
    case ADMIN = 2;

    /**
     * @return string
     */
    public function title(): string
    {
        return match ($this) {
            self::USER => 'Пользователь',
            self::ADMIN => 'Админ'
        };
    }

//    public function titleRole()
//    {
//        return match ($this) {
//            self::USER => 'user',
//            self::ADMIN => 'admin'
//        };
//    }
}
