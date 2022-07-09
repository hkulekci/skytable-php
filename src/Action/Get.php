<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Get
{
    protected string $key;
    public function __construct($key)
    {
        $this->key = $key;
    }

    public function query(): Action
    {
        return new Action(['get', $this->key]);
    }
}
