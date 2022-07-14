<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Inspect;

use Skytable\Action\Action;

class Keyspaces extends Action
{
    public function __construct()
    {
        $this->elements = ['inspect', 'keyspaces'];
    }
}
