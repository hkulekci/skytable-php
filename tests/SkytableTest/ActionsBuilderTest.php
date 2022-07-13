<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest;

use PHPUnit\Framework\TestCase;
use Skytable\Action\Heya;
use Skytable\Action\Whereami;
use Skytable\ActionsBuilder;

class ActionsBuilderTest extends TestCase
{
    public function testActionBuilderHeya(): void
    {
        $actionBuilder = new ActionsBuilder();

        $actionBuilder->add((new Heya()));

        $this->assertEquals("*1\n~1\n4\nheya\n", $actionBuilder->payload());
    }

    public function testActionBuilderWhereAmI(): void
    {
        $actionBuilder = new ActionsBuilder();

        $actionBuilder->add((new Whereami()));

        $this->assertEquals("*1\n~1\n8\nwhereami\n", $actionBuilder->payload());
    }
}
