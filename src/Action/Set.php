<?php

/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Set
{
    protected string $key;
    protected string $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function query(): Action
    {
        return new Action(['set', $this->key, $this->value]);
    }
}
