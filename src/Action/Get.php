<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Get extends Action
{
    public function __construct($key)
    {
        $this->elements = ['get', $key];
    }
}
