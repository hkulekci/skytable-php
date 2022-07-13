<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Set extends Action
{
    public function __construct(string $key, $value)
    {
        $this->elements = ['set', $key, $value];
    }
}
