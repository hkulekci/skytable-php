<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Lget;

use Skytable\Action\Action;

class Limit extends Action
{
    public function __construct(string $key, int $limit)
    {
        $this->elements = ['lget', $key, 'limit', $limit];
    }
}
