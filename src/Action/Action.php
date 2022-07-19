<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

use RuntimeException;

class Action implements ActionInterface
{
    protected array $elements;

    /**
     * @throws RuntimeException
     */
    public function getPayload(): string
    {
        $payload = $this->preparePayload($this->elements);
        return implode('', $payload);
    }

    private function preparePayload($elements) {
        $payload = [
            '~' . count($this->elements) . "\n",
        ];
        foreach ($this->elements as $element) {
            if (is_array($element)) {
                $payload += $this->preparePayload($element);
            } else if (is_string($element) || is_numeric($element)) {
                $payload[] = strlen($element) . "\n";
                $payload[] = $element . "\n";
            } else {
                throw new RuntimeException('Invalid element type : ' . gettype($element));
            }
        }

        return $payload;
    }
}
