<?php


namespace Mleczek\Enum\Tests\Enums;


use Mleczek\Enum\Enum;

final class MyEnum extends Enum
{
    public static function sample(): self
    {
        return self::make('A');
    }
}