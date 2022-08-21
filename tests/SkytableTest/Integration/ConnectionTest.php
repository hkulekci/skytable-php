<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Integration;

use Mockery;
use Skytable\Action\Heya;
use Skytable\ActionsBuilder;
use Skytable\Connection;
use Skytable\DataType\Primitive\StringType;
use Skytable\Exception\ServerException;
use Socket\Raw\Socket;

class ConnectionTest extends BaseIntegration
{
    public function testExecute(): void
    {
        $connection = new Connection('127.0.0.1');
        $actionBuilder = new ActionsBuilder();
        $actionBuilder->add(new Heya());
        $response = $connection->execute($actionBuilder);
        $this->assertInstanceOf(StringType::class, $response->getLastData());
        $this->assertEquals('HEY!', $response->getLastData()->getValue());
    }

    public function testConnectionWithWrongInformation(): void
    {
        $this->expectException(ServerException::class);
        new Connection('127.0.0.1', 2004);
    }

    public function testConnectionWithWrongInformation2(): void
    {
        $this->expectException(ServerException::class);
        new Connection('127.0.0.1', 2004);
    }

    /**
     * @throws ServerException
     */
    public function testConnectionWithCallback(): void
    {
        $function = function (Connection $connection) {
            $this->assertInstanceOf(Connection::class, $connection);
        };
        $mock = Mockery::mock($function);
        $mock->shouldReceive('__invoke')->once();

        new Connection('127.0.0.1', 2003, $function);
    }

    /**
     * @throws ServerException
     */
    public function testConnectionCallbackWithErrors(): void
    {
        $this->expectException(ServerException::class);
        $function = function (Connection $connection) {
            $this->assertInstanceOf(Connection::class, $connection);
        };
        $mock = Mockery::mock($function);
        $mock->shouldReceive('__invoke')->never();

        new Connection('127.0.0.1', 2004, $function);
    }

    /**
     * @throws ServerException
     */
    public function testConnectionWithWriteErrors(): void
    {
        $this->expectException(ServerException::class);
        $this->expectExceptionMessage("writing data failed. reason: Writing Error");
        $socket = Mockery::mock(Socket::class);
        $socket->shouldReceive('write')->andThrow(new \Exception('Writing Error'));

        $socket->shouldReceive('recv')->andReturn('~1\n4\nheya\n');

        $mock = Mockery::mock(Connection::class)->makePartial();
        $mock->shouldReceive('getSocket')->andReturn($socket);

        $actionBuilder = new ActionsBuilder();
        $actionBuilder->add(new Heya());
        $mock->execute($actionBuilder);
    }

    /**
     * @throws ServerException
     */
    public function testConnectionWithReadErrors(): void
    {
        $this->expectException(ServerException::class);
        $this->expectExceptionMessage("receiving data failed. reason: Receiving Error");
        $socket = Mockery::mock(Socket::class);
        $socket->shouldReceive('write')->andReturn(10);
        $socket->shouldReceive('recv')->andThrow(new \Exception('Receiving Error'));

        $mock = Mockery::mock(Connection::class)->makePartial();
        $mock->shouldReceive('getSocket')->andReturn($socket);

        $actionBuilder = new ActionsBuilder();
        $actionBuilder->add(new Heya());
        $mock->execute($actionBuilder);
    }
}
