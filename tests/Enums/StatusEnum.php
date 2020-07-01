<?php


namespace Mleczek\Enum\Tests\Enums;


use Mleczek\Enum\Enum;

final class StatusEnum extends Enum
{
    public static function inactive(): self
    {
        return self::make('I', 'Inactive');
    }

    public static function active(): self
    {
        return self::make('A', 'Active');
    }
}