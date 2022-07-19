<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Unit\Action;

use PHPUnit\Framework\TestCase;
use Skytable\Action\Drop\Keyspace;
use Skytable\Action\Drop\Table;

class DropActionsTest extends TestCase
{
    public function testDropKeyspaceAction(): void
    {
        $action = new Keyspace('foo');

        $this->assertEquals("~3\n4\ndrop\n8\nkeyspace\n3\nfoo\n", $action->getPayload());
    }

    public function testCreateTableAction(): void
    {
        $action = new Table('foo');

        $this->assertEquals(
            "~3\n4\ndrop\n5\ntable\n3\nfoo\n",
            $action->getPayload()
        );
    }
}
