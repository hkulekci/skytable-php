<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Drop;

use Skytable\Action\Action;

class Table extends Action
{
    public function __construct(string $name)
    {
        $this->elements = ['drop', 'table', $name];
    }
}
