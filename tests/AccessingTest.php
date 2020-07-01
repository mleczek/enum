<?php


namespace Mleczek\Enum\Tests;


use Mleczek\Enum\Tests\Enums\RankEnum;
use Mleczek\Enum\Tests\Enums\StatusEnum;
use PHPUnit\Framework\TestCase;

class AccessingTest extends TestCase
{
    public function testStaticMethod()
    {
        $this->assertSame('Inactive', StatusEnum::inactive()->getDisplayName());
    }

    public function testAllValues()
    {
        $this->assertIsArray(StatusEnum::all());
        $this->assertCount(2, StatusEnum::all());
        $this->assertContains(StatusEnum::active(), StatusEnum::all());
        $this->assertContains(StatusEnum::inactive(), StatusEnum::all());
    }

    public function testAllValuesOrder()
    {
        $this->assertSame('Active', StatusEnum::all()[0]->getDisplayName());
        $this->assertSame('Inactive', StatusEnum::all()[1]->getDisplayName());

        $this->assertSame('Silver', RankEnum::all()[0]->getDisplayName());
        $this->assertSame('Gold', RankEnum::all()[1]->getDisplayName());
        $this->assertSame('Master', RankEnum::all()[2]->getDisplayName());
    }
}