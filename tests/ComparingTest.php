<?php


namespace Mleczek\Enum\Tests;


use Mleczek\Enum\Tests\Enums\MyEnum;
use Mleczek\Enum\Tests\Enums\StatusEnum;
use PHPUnit\Framework\TestCase;

class ComparingTest extends TestCase
{
    public function testIdenticalComparision()
    {
        $this->assertTrue(StatusEnum::active() === StatusEnum::active());
        $this->assertFalse(StatusEnum::active() === MyEnum::sample());
        $this->assertTrue(StatusEnum::active() < StatusEnum::inactive(), 'Active < Inactive');
        $this->assertFalse(StatusEnum::active() > StatusEnum::inactive(), 'Active > Inactive');
    }
}