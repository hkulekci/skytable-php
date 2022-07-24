<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Functional;

use Skytable\DataType\CodeType;
use Skytable\DataType\Primitive\FloatType;
use Skytable\DataType\Primitive\IntType;
use Skytable\DataType\Primitive\StringType;
use SkytableTest\Integration\BaseIntegration;

class SysActionsTest extends BaseIntegration
{
    public function testSysMetricHealth(): void
    {
        $response = $this->client->sys_metric_health();
        $this->assertInstanceOf(StringType::class, $response);
        $this->assertEquals('good', $response->getValue());
    }

    public function testSysMetricStorage(): void
    {
        $response = $this->client->flushdb();
        $this->assertInstanceOf(CodeType::class, $response);
        $this->assertEquals(true, $response->getValue());
        $response = $this->client->sys_metric_storage();
        $this->assertInstanceOf(IntType::class, $response);
        $this->assertIsInt($response->getValue());
    }

    public function testSysInfoProtocol(): void
    {
        $response = $this->client->sys_info_protocol();
        $this->assertInstanceOf(StringType::class, $response);
        $this->assertIsString($response->getValue());
    }

    public function testSysInfoProtover(): void
    {
        $response = $this->client->sys_info_protover();
        $this->assertInstanceOf(FloatType::class, $response);
        $this->assertIsFloat($response->getValue());
    }

    public function testSysInfoVersion(): void
    {
        $response = $this->client->sys_info_version();
        $this->assertInstanceOf(StringType::class, $response);
        $this->assertIsString($response->getValue());
    }
}
