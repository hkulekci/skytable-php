<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

use Skytable\Exception\ActionException;
use Skytable\Exception\InvalidArgumentException;

class Action implements ActionInterface
{
    protected array $elements;

    /**
     * @throws ActionException
     */
    public function getPayload(): string
    {
        $payload = $this->preparePayload($this->elements);
        return implode('', $payload);
    }

    /**
     * @throws ActionException
     */
    private function preparePayload($elements): array
    {
        $payload = [
            '~' . count($elements) . "\n",
        ];
        foreach ($elements as $element) {
            if (is_array($element)) {
                $payload += $this->preparePayload($element);
            } else if (is_string($element) || is_numeric($element)) {
                $payload[] = strlen($element) . "\n";
                $payload[] = $element . "\n";
            } else {
                throw new InvalidArgumentException('Invalid element type : ' . gettype($element));
            }
        }

        return $payload;
    }
}
