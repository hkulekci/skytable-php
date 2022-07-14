<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Lget;

use Skytable\Action\Action;

class Valueat extends Action
{
    public function __construct(string $key, int $index)
    {
        $this->elements = ['lget', $key, 'valueat', $index];
    }
}
