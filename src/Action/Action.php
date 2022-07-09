<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Action
{
    protected array $elements;

    public function __construct($elements)
    {
        $this->elements = $elements;
    }

    public function getPayload(): string
    {
        $payload = [
            '~' . count($this->elements) . "\n",
        ];
        foreach ($this->elements as $element) {
            $payload[] = strlen($element) . "\n";
            $payload[] = $element . "\n";
        }

        return implode('', $payload);
    }
}
