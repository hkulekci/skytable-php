<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Auth;

use Skytable\Action\Action;

class Login extends Action
{
    public function __construct(string $username, string $token)
    {
        $this->elements = ['auth', 'login', $username, $token];
    }
}
