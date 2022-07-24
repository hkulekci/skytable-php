<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Integration;

use RuntimeException;
use Skytable\Action\Heya;
use Skytable\ActionsBuilder;
use Skytable\DataType\CodeType;
use Skytable\DataType\Primitive\IntType;
use Skytable\DataType\Primitive\StringType;
use Skytable\Exception\ActionException;

class ClientTest extends BaseIntegration
{
    public function testExecute(): void
    {
        $actionBuilder = new ActionsBuilder();
        $actionBuilder->add(new Heya());
        $response = $this->client->execute($actionBuilder);
        $this->assertInstanceOf(StringType::class, $response->getLastData());
        $this->assertEquals('HEY!', $response->getLastData()->getValue());
    }

    public function testDbSizeWithClient(): void
    {
        $response = $this->client->flushdb();
        $this->assertInstanceOf(CodeType::class, $response);
        $this->assertEquals(true, $response->getValue());
        $response = $this->client->dbsize();
        $this->assertInstanceOf(IntType::class, $response);
        $this->assertEquals(0, $response->getValue());
    }

    public function testUnsupportedAction(): void
    {
        $this->expectException(ActionException::class);
        $this->expectExceptionMessage('Action SomeOtherAction not found');
        $this->client->someOtherAction();
    }

    public function testUnsupportedActionNamespaced(): void
    {
        $this->expectException(ActionException::class);
        $this->expectExceptionMessage('Action Some\Other\Action not found');
        $this->client->some_other_action();
    }
}
