<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Mget extends Action
{
    public function __construct(array $keys)
    {
        $this->elements = ['mget', ...$keys];
    }
}
