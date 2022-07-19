<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Lget;

use Skytable\Action\Action;

class Len extends Action
{
    public function __construct(string $key)
    {
        $this->elements = ['lget', $key, 'len'];
    }
}