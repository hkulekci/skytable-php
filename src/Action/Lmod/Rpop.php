<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Lmod;

use Skytable\Action\Action;

class Rpop extends Action
{
    public function __construct($key)
    {
        $this->elements = ['lmod', $key, 'pop', 0];
    }
}
