<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Heya
{
    public function query(): Action
    {
        return new Action(['heya']);
    }
}
