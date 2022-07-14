<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Action;

use PHPUnit\Framework\TestCase;
use Skytable\Action\Dbsize;
use Skytable\Action\Del;
use Skytable\Action\Exists;
use Skytable\Action\Flushdb;
use Skytable\Action\Get;
use Skytable\Action\Heya;
use Skytable\Action\Lget;
use Skytable\Action\Lset;
use Skytable\Action\Mget;
use Skytable\Action\Mpop;
use Skytable\Action\Pop;
use Skytable\Action\Select;
use Skytable\Action\Set;
use Skytable\Action\Update;
use Skytable\Action\Whereami;

class ActionsTest extends TestCase
{
    public function testDbsizeAction(): void
    {
        $action = new Dbsize();

        $this->assertEquals("~1\n6\ndbsize\n", $action->getPayload());
    }

    public function testDelAction(): void
    {
        $action = new Del('key');

        $this->assertEquals("~2\n3\ndel\n3\nkey\n", $action->getPayload());
    }

    public function testExistsAction(): void
    {
        $action = new Exists(['key']);

        $this->assertEquals("~2\n6\nexists\n3\nkey\n", $action->getPayload());
    }

    public function testFlushdbAction(): void
    {
        $action = new Flushdb();

        $this->assertEquals("~1\n7\nflushdb\n", $action->getPayload());
    }

    public function testGetAction(): void
    {
        $action = new Get('key');

        $this->assertEquals("~2\n3\nget\n3\nkey\n", $action->getPayload());
    }

    public function testHeyaAction(): void
    {
        $action = new Heya();

        $this->assertEquals("~1\n4\nheya\n", $action->getPayload());
    }

    public function testLgetAction(): void
    {
        $action = new Lget('key');

        $this->assertEquals("~2\n4\nlget\n3\nkey\n", $action->getPayload());
    }

    public function testLsetAction(): void
    {
        $action = new Lset('key');

        $this->assertEquals("~2\n4\nlset\n3\nkey\n", $action->getPayload());
    }

    public function testLsetWithValueAction(): void
    {
        $action = new Lset('key', ['foo']);

        $this->assertEquals("~3\n4\nlset\n3\nkey\n3\nfoo\n", $action->getPayload());
    }

    public function testLsetWithValuesAction(): void
    {
        $action = new Lset('key', ['foo', 'bar']);

        $this->assertEquals("~4\n4\nlset\n3\nkey\n3\nfoo\n3\nbar\n", $action->getPayload());
    }

    public function testMgetAction(): void
    {
        $action = new Mget(['foo', 'bar']);

        $this->assertEquals("~3\n4\nmget\n3\nfoo\n3\nbar\n", $action->getPayload());
    }

    public function testMpopAction(): void
    {
        $action = new Mpop(['foo', 'bar']);

        $this->assertEquals("~3\n4\nmpop\n3\nfoo\n3\nbar\n", $action->getPayload());
    }

    public function testPopAction(): void
    {
        $action = new Pop('foo');

        $this->assertEquals("~2\n3\npop\n3\nfoo\n", $action->getPayload());
    }

    public function testSelectAction(): void
    {
        $action = new Select('foo');

        $this->assertEquals("~2\n3\nuse\n3\nfoo\n", $action->getPayload());
    }

    public function testSetAction(): void
    {
        $action = new Set('foo', 'bar');

        $this->assertEquals("~3\n3\nset\n3\nfoo\n3\nbar\n", $action->getPayload());
    }

    public function testUpdateAction(): void
    {
        $action = new Update('foo', 'bar');

        $this->assertEquals("~3\n6\nupdate\n3\nfoo\n3\nbar\n", $action->getPayload());
    }

    public function testWhereamiAction(): void
    {
        $action = new Whereami();

        $this->assertEquals("~1\n8\nwhereami\n", $action->getPayload());
    }
}
