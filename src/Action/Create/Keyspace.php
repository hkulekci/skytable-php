<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Create;

use Skytable\Action\Action;

class Keyspace extends Action
{
    public function __construct($name)
    {
        $this->elements = ['create', 'keyspace', $name];
    }
}
