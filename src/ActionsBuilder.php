<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable;

use Skytable\Action\ActionInterface;

class ActionsBuilder
{
    protected array $actions;

    public function addQuery(ActionInterface $action): static
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
