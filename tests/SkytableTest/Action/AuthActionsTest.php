<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace SkytableTest\Action;

use PHPUnit\Framework\TestCase;
use Skytable\Action\Auth\Claim;
use Skytable\Action\Auth\Login;

class AuthActionsTest extends TestCase
{
    public function testAuthClaimAction(): void
    {
        $action = new Claim('origin_key');

        $this->assertEquals("~3\n4\nauth\n5\nclaim\n10\norigin_key\n", $action->getPayload());
    }

    public function testAuthLoginAction(): void
    {
        $action = new Login('username', 'password');

        $this->assertEquals("~4\n4\nauth\n5\nlogin\n8\nusername\n8\npassword\n", $action->getPayload());
    }
}
