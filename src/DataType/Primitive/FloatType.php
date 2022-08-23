<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable\DataType\Primitive;

use Skytable\DataType\TypeInterface;

class FloatType implements TypeInterface
{
    final public const SYMBOL = '%';

    private float $value;
    private string $length;

    public function __construct(string $meta)
    {
        $this->length = $meta;
    }

    public function getLength(): int
    {
        return (int) $this->length;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function pull(&$lines): void
    {
        $this->value = array_shift($lines);
    }
}
