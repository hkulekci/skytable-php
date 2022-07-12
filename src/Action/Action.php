<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

class Action implements ActionInterface
{
    protected array $elements;

    public function getPayload(): string
    {
        $payload = [
            '~' . count($this->elements) . "\n",
        ];
        foreach ($this->elements as $element) {
            if (is_array($element)) {

            } else if (is_string($element)) {
                $payload[] = strlen($element) . "\n";
                $payload[] = $element . "\n";
            } else {
                throw new \Exception('Invalid element type');
            }
        }

        return implode('', $payload);
    }
}
