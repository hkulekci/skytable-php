<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

use Skytable\Exception\ActionException;

class Action implements ActionInterface
{
    protected array $elements;

    /**
     * @throws ActionException
     */
    public function getPayload(): string
    {
        $payload = $this->preparePayload();
        return implode('', $payload);
    }

    /**
     * @throws ActionException
     */
    private function preparePayload(): array
    {
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
                throw new ActionException('Invalid element type : ' . gettype($element));
            }
        }

        return $payload;
    }
}
