<?php


namespace Mleczek\Enum\Tests;


use Mleczek\Enum\Tests\Enums\CaseSensitiveEnum;
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

    public function testAllSortedByValue()
    {
        $this->assertSame('Active', StatusEnum::all()[0]->getDisplayName());
        $this->assertSame('Inactive', StatusEnum::all()[1]->getDisplayName());

        $this->assertSame('Silver', RankEnum::all()[0]->getDisplayName());
        $this->assertSame('Gold', RankEnum::all()[1]->getDisplayName());
        $this->assertSame('Master', RankEnum::all()[2]->getDisplayName());
    }

    public function testAllSortedByValueCaseInsensitive()
    {
        $this->assertSame('aa', CaseSensitiveEnum::all()[0]->getValue());
        $this->assertSame('Ab', CaseSensitiveEnum::all()[1]->getValue());
        $this->assertSame('Ba', CaseSensitiveEnum::all()[2]->getValue());
        $this->assertSame('bb', CaseSensitiveEnum::all()[3]->getValue());
    }
}