<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Mpop extends Action
{
    public function __construct(array $keys)
    {
        $this->elements = ['mpop', ...$keys];
    }
}
