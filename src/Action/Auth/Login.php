<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Auth;

use Skytable\Action\Action;

class Login
{
    protected string $username;
    protected string $token;

    public function __construct($username, $token)
    {
        $this->username = $username;
        $this->token = $token;
    }

    public function query(): Action
    {
        return new Action(['auth', 'login', $this->username, $this->token]);
    }
}
