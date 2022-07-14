<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\DataType;

use PHPUnit\Framework\TestCase;
use Skytable\DataType\Array\AnyArrayType;
use Skytable\DataType\Array\ArrayType;
use Skytable\DataType\Array\FlatArrayType;
use Skytable\DataType\Array\TypedArrayType;
use Skytable\DataType\Array\TypedNonNullArrayType;
use Skytable\Response;

class ArrayTypesTest extends TestCase
{
    public function testTypedNonNullArrayType(): void
    {
        $response = new Response("^+2\n3\nfoo\n3\nbar\n");

        $this->assertInstanceOf(TypedNonNullArrayType::class, $response->getLastData());
        $this->assertEquals(2, $response->getLastData()->getLength());
        $this->assertEquals(['foo', 'bar'], $response->getLastData()->getValue());
    }

    public function testTypedArrayType(): void
    {
        $response = new Response("@+2\n3\nfoo\n3\nbar\n");

        $this->assertInstanceOf(TypedArrayType::class, $response->getLastData());
        $this->assertEquals(2, $response->getLastData()->getLength());
        $this->assertEquals(['foo', 'bar'], $response->getLastData()->getValue());
    }

    public function testFlatArrayType(): void
    {
        $response = new Response("_+2\n3\nfoo\n3\nbar\n");

        $this->assertInstanceOf(FlatArrayType::class, $response->getLastData());
        $this->assertEquals(2, $response->getLastData()->getLength());
        $this->assertEquals(['foo', 'bar'], $response->getLastData()->getValue());
    }

    public function testArrayType(): void
    {
        $response = new Response("&+2\n3\nfoo\n3\nbar\n");

        $this->assertInstanceOf(ArrayType::class, $response->getLastData());
        $this->assertEquals(2, $response->getLastData()->getLength());
        $this->assertEquals(['foo', 'bar'], $response->getLastData()->getValue());
    }

    public function testAnyArrayType(): void
    {
        $response = new Response("~+2\n3\nfoo\n3\nbar\n");

        $this->assertInstanceOf(AnyArrayType::class, $response->getLastData());
        $this->assertEquals(2, $response->getLastData()->getLength());
        $this->assertEquals(['foo', 'bar'], $response->getLastData()->getValue());
    }
}
