<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Lmod;

use Skytable\Action\Action;

class Push extends Action
{
    public function __construct($key, $value)
    {
        $this->elements = ['lmod', $key, 'push', $value];
    }
}
