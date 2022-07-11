<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Dbsize extends Action
{
    public function __construct()
    {
        $this->elements = ['dbsize'];
    }
}
