<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Unit\Action;

use PHPUnit\Framework\TestCase;
use Skytable\Action\Lmod\Clear;
use Skytable\Action\Lmod\Pop;
use Skytable\Action\Lmod\Push;
use Skytable\Action\Lmod\Rpop;

class LmodActionsTest extends TestCase
{
    public function testLmodClearAction(): void
    {
        $action = new Clear('key');

        $this->assertEquals("~3\n4\nlmod\n3\nkey\n5\nclear\n", $action->getPayload());
    }

    public function testLmodPopAction(): void
    {
        $action = new Pop('key');

        $this->assertEquals("~3\n4\nlmod\n3\nkey\n3\npop\n", $action->getPayload());
    }

    public function testLmodPushAction(): void
    {
        $action = new Push('key', 'value');

        $this->assertEquals("~4\n4\nlmod\n3\nkey\n4\npush\n5\nvalue\n", $action->getPayload());
    }

    public function testLmodRpopAction(): void
    {
        $action = new Rpop('key');

        $this->assertEquals("~4\n4\nlmod\n3\nkey\n3\npop\n1\n0\n", $action->getPayload());
    }
}
