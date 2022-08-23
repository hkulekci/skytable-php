<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable\DataType\Primitive;

use Skytable\DataType\TypeInterface;

class StringType implements TypeInterface
{
    final public const SYMBOL = '+';

    private string $length;
    private string $value;

    public function __construct(string $meta)
    {
        $this->length = $meta;
    }

    public function getLength(): int
    {
        return (int) $this->length;
    }

    public function pull(&$lines): void
    {
        $this->value = array_shift($lines);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return __CLASS__ . ' : ' . self::SYMBOL . $this->length . ' - ' . $this->getValue();
    }
}
