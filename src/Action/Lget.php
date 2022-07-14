<?php
/**
 *
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Lget extends Action
{
    /**
     * @param string $key
     * @param string|null $action    [limit <limit>, len, valueat <index>, first, last, range <start> <stop>]
     * @param ...$args
     */
    public function __construct(string $key, string $action = null, ...$args)
    {
        $this->elements = ['lget', $key];
        if ($action) {
            $this->elements[] = $action;
        }
        if ($args) {
            $this->elements = array_merge($this->elements, $args);
        }
    }
}
