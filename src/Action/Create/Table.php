<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Create;

use Skytable\Action\Action;

class Table extends Action
{
    public function __construct($name, $keyMap)
    {
        $this->elements = ['create', 'table', $name, $keyMap];
    }
}
