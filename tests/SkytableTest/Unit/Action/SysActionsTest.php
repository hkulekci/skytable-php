<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Unit\Action;

use PHPUnit\Framework\TestCase;
use Skytable\Action\Sys\Info\Protocol;
use Skytable\Action\Sys\Info\Protover;
use Skytable\Action\Sys\Info\Version;
use Skytable\Action\Sys\Metric\Health;
use Skytable\Action\Sys\Metric\Storage;

class SysActionsTest extends TestCase
{
    public function testSysInfoProtocolAction(): void
    {
        $action = new Protocol();

        $this->assertEquals("~3\n3\nsys\n4\ninfo\n8\nprotocol\n", $action->getPayload());
    }

    public function testSysInfoProtoverAction(): void
    {
        $action = new Protover();

        $this->assertEquals("~3\n3\nsys\n4\ninfo\n8\nprotover\n", $action->getPayload());
    }

    public function testSysInfoVersionAction(): void
    {
        $action = new Version();

        $this->assertEquals("~3\n3\nsys\n4\ninfo\n7\nversion\n", $action->getPayload());
    }

    public function testSysMetricHealthAction(): void
    {
        $action = new Health();

        $this->assertEquals("~3\n3\nsys\n6\nmetric\n6\nhealth\n", $action->getPayload());
    }

    public function testSysMetricStorageAction(): void
    {
        $action = new Storage();

        $this->assertEquals("~3\n3\nsys\n6\nmetric\n7\nstorage\n", $action->getPayload());
    }
}
