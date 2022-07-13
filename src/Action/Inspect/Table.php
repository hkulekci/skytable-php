<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action\Inspect;

use Skytable\Action\Action;

class Table extends Action
{
    public function __construct(string $entity = null)
    {
        $this->elements = ['inspect', 'keyspace'];
        if ($entity) {
            $this->elements[] = $entity;
        }
    }
}
