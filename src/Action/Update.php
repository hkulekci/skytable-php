<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Update extends Action
{
    public function __construct($key, $value)
    {
        $this->elements = ['update', $key, $value];
    }
}
