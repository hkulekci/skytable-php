<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Unit;

use PHPUnit\Framework\TestCase;
use Skytable\Action\Heya;
use Skytable\Action\Whereami;
use Skytable\ActionsBuilder;

class UtilitiesTest extends TestCase
{
    public function testStrlpopFunction(): void
    {
        $string = 'test_string';

        $this->assertEquals('t', strlpop($string));
    }

    public function testStrlpopFunctionForEmptyString(): void
    {
        $string = '';

        $this->assertEquals('', strlpop($string));
    }
}
