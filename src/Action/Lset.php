<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Lset extends Action
{
    public function __construct($key)
    {
        $this->elements = ['lset', $key];
    }
}
