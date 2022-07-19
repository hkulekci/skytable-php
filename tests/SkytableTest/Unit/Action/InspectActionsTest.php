<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Unit\Action;

use PHPUnit\Framework\TestCase;
use Skytable\Action\Inspect\Keyspace;
use Skytable\Action\Inspect\Keyspaces;
use Skytable\Action\Inspect\Table;

class InspectActionsTest extends TestCase
{
    public function testInspectKeyspaceAction(): void
    {
        $action = new Keyspace();

        $this->assertEquals("~2\n7\ninspect\n8\nkeyspace\n", $action->getPayload());
    }

    public function testInspectKeyspaceWithEntityAction(): void
    {
        $action = new Keyspace('foo');

        $this->assertEquals("~3\n7\ninspect\n8\nkeyspace\n3\nfoo\n", $action->getPayload());
    }

    public function testInspectKeyspacesAction(): void
    {
        $action = new Keyspaces('foo');

        $this->assertEquals("~2\n7\ninspect\n9\nkeyspaces\n", $action->getPayload());
    }

    public function testInspectTableAction(): void
    {
        $action = new Table();

        $this->assertEquals("~2\n7\ninspect\n5\ntable\n", $action->getPayload());
    }

    public function testInspectTableWithEntityAction(): void
    {
        $action = new Table('foo');

        $this->assertEquals("~3\n7\ninspect\n5\ntable\n3\nfoo\n", $action->getPayload());
    }
}
