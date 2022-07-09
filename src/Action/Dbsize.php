<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Dbsize
{
    public function query(): Action
    {
        return new Action(['dbsize']);
    }
}
