<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Integration;

use PHPUnit\Framework\TestCase;
use Skytable\Client;
use Skytable\Connection;

class BaseIntegration extends TestCase
{
    protected Connection $connection;
    protected Client $client;

    public function setUp(): void
    {
        $this->connection = new Connection('127.0.0.1', 2003);
        $this->client = new Client($this->connection);
    }
}
