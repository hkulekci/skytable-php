<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\DataType;

use PHPUnit\Framework\TestCase;
use Skytable\DataType\ActionType;
use Skytable\DataType\CodeType;
use Skytable\DataType\DefaultType;
use Skytable\Response;

class GenericTypesTest extends TestCase
{
    public function testActionType(): void
    {
        $response = new Response("*1\n");

        $this->assertInstanceOf(ActionType::class, $response->getLastData());
        $this->assertEquals(0, $response->getLastData()->getLength());
        $this->assertNull($response->getLastData()->getValue());
    }

    public function testCodeType(): void
    {
        $response = new Response("*1\n!11\nwrong-model\n");

        $this->assertInstanceOf(CodeType::class, $response->getLastData());
        $this->assertEquals(11, $response->getLastData()->getLength());
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('wrong-model');
        $response->getLastData()->getValue();
    }

    public function testDefaultType(): void
    {
        // wrongly formatted response
        $response = new Response("*1\n=15\nsome-typed-data\n");

        $this->assertInstanceOf(DefaultType::class, $response->getLastData());
        $this->assertEquals(15, $response->getLastData()->getLength());
        $this->assertEquals('some-typed-data', $response->getLastData()->getValue());
    }
}
