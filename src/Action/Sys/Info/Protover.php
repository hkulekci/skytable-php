<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Sys\Info;

use Skytable\Action\Action;

class Protover extends Action
{
    public function __construct()
    {
        $this->elements = ['sys', 'info', 'protover'];
    }
}
