<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Auth;

use Skytable\Action\Action;

class Claim
{
    protected string $originKey;

    public function __construct($originKey)
    {
        $this->originKey = $originKey;
    }

    public function query(): Action
    {
        return new Action(['auth', 'claim', $this->originKey]);
    }
}
