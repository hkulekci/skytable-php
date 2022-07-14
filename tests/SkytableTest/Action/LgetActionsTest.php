<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Action;

use PHPUnit\Framework\TestCase;
use Skytable\Action\Lget\First;
use Skytable\Action\Lget\Last;
use Skytable\Action\Lget\Len;
use Skytable\Action\Lget\Limit;
use Skytable\Action\Lget\Range;
use Skytable\Action\Lget\Valueat;

class LgetActionsTest extends TestCase
{
    public function testLgetFirstAction(): void
    {
        $action = new First('key');

        $this->assertEquals("~3\n4\nlget\n3\nkey\n5\nfirst\n", $action->getPayload());
    }

    public function testLgetLastAction(): void
    {
        $action = new Last('key');

        $this->assertEquals("~3\n4\nlget\n3\nkey\n4\nlast\n", $action->getPayload());
    }

    public function testLgetLenAction(): void
    {
        $action = new Len('key');

        $this->assertEquals("~3\n4\nlget\n3\nkey\n3\nlen\n", $action->getPayload());
    }

    public function testLgetLimitAction(): void
    {
        $action = new Limit('key', 10);

        $this->assertEquals("~4\n4\nlget\n3\nkey\n5\nlimit\n2\n10\n", $action->getPayload());
    }

    public function testLgetRangeWithStartAction(): void
    {
        $action = new Range('key', 2);

        $this->assertEquals("~4\n4\nlget\n3\nkey\n5\nrange\n1\n2\n", $action->getPayload());
    }

    public function testLgetRangeWithStartAndStopAction(): void
    {
        $action = new Range('key', 2, 10);

        $this->assertEquals("~5\n4\nlget\n3\nkey\n5\nrange\n1\n2\n2\n10\n", $action->getPayload());
    }

    public function testLgetValueatAction(): void
    {
        $action = new Valueat('key', 10);

        $this->assertEquals("~4\n4\nlget\n3\nkey\n7\nvalueat\n2\n10\n", $action->getPayload());
    }
}
