<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Pop extends Action
{
    public function __construct(string $key)
    {
        $this->elements = ['pop', $key];
    }
}
