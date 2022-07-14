<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Action;

use PHPUnit\Framework\TestCase;
use Skytable\Action\Create\Keyspace;
use Skytable\Action\Create\Table;

class CreateActionsTest extends TestCase
{
    public function testCreateKeyspaceAction(): void
    {
        $action = new Keyspace('foo');

        $this->assertEquals("~3\n6\ncreate\n8\nkeyspace\n3\nfoo\n", $action->getPayload());
    }

    public function testCreateTableAction(): void
    {
        $action = new Table('foo', 'keymap(str,list<str>)');

        $this->assertEquals(
            "~4\n6\ncreate\n5\ntable\n3\nfoo\n21\nkeymap(str,list<str>)\n",
            $action->getPayload()
        );
    }
}
