<?php


namespace Mleczek\Enum\Tests\Enums;


use Mleczek\Enum\Enum;

final class CaseSensitiveEnum extends Enum
{
    public static function firstA(): self
    {
        return self::make('aa');
    }

    public static function secondA(): self
    {
        return self::make('Ab');
    }

    public static function firstB(): self
    {
        return self::make('Ba');
    }

    public static function secondB(): self
    {
        return self::make('bb');
    }
}