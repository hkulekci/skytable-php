<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Auth;

use Skytable\Action\Action;

class Claim extends Action
{
    public function __construct(string $originKey)
    {
        $this->elements = ['auth', 'claim', $originKey];
    }
}
