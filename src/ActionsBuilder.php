<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable;

use Skytable\Action\Action;

class ActionsBuilder
{
    protected array $actions;

    public function addQuery(Action $action): static
    {
        $this->actions[] = $action;

        return $this;
    }

    public function payload(): string
    {
        $payload = [
            "*" . count($this->actions) . "\n",
        ];
        foreach ($this->actions as $action) {
            $payload[] = $action->getPayload();
        }

        return implode('', $payload);
    }
}
