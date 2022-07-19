<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Unit\DataType;

use PHPUnit\Framework\TestCase;
use Skytable\DataType\Primitive\BinaryStringType;
use Skytable\DataType\Primitive\FloatType;
use Skytable\DataType\Primitive\IntType;
use Skytable\DataType\Primitive\StringType;
use Skytable\Response;

class PrimitiveTypesTest extends TestCase
{
    public function testBinaryStringType(): void
    {
        $response = new Response("?6\nhaydar\n");

        $lastData = $response->getLastData();
        $this->assertInstanceOf(BinaryStringType::class, $lastData);
        $this->assertEquals(strlen('haydar'), $lastData->getLength());
        $this->assertEquals('haydar', $lastData->getValue());
    }

    public function testFloatType(): void
    {
        $response = new Response("%3\n2.5\n");

        $this->assertInstanceOf(FloatType::class, $response->getLastData());
        $this->assertEquals(3, $response->getLastData()->getLength());
        $this->assertEquals(2.5, $response->getLastData()->getValue());
    }

    public function testIntType(): void
    {
        $response = new Response(":3\n255\n");

        $this->assertInstanceOf(IntType::class, $response->getLastData());
        $this->assertEquals(3, $response->getLastData()->getLength());
        $this->assertEquals(255, $response->getLastData()->getValue());
    }

    public function testStringType(): void
    {
        $response = new Response("+3\n255\n");

        $this->assertInstanceOf(StringType::class, $response->getLastData());
        $this->assertEquals(3, $response->getLastData()->getLength());
        $this->assertEquals('255', $response->getLastData()->getValue());
    }
}
