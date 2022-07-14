<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Lget;

use Skytable\Action\Action;

class Range extends Action
{
    public function __construct(string $key, int $start, int $stop = null)
    {
        $this->elements = ['lget', $key, 'range', $start];
        if ($stop !== null) {
            $this->elements[] = $stop;
        }
    }
}
