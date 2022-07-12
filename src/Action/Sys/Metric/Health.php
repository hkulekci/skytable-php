<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Sys\Metric;

use Skytable\Action\Action;

class Health extends Action
{
    public function __construct()
    {
        $this->elements = ['sys', 'metric', 'health'];
    }
}
