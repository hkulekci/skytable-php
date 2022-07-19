<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Integration;

use Skytable\Action\Heya;
use Skytable\ActionsBuilder;
use Skytable\DataType\Primitive\StringType;

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
}
