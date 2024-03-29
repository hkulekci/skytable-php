<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Select extends Action
{
    public function __construct(string $name)
    {
        $this->elements = ['use', $name];
    }
}
