<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Flushdb extends Action
{
    public function __construct()
    {
        $this->elements = ['flushdb'];
    }
}
