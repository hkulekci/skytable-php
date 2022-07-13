<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Lmod;

use Skytable\Action\Action;

class Pop extends Action
{
    public function __construct(string $key)
    {
        $this->elements = ['lmod', $key, 'pop'];
    }
}
