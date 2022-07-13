<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable\DataType\Primitive;

use Skytable\DataType\TypeInterface;

class IntType implements TypeInterface
{
    public const SYMBOL = ':';

    private int $value;
    private int $length;

    public function __construct(string $meta)
    {
        $this->length = $meta;
    }

    public function getLength(): int
    {
        return (int) $this->length;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function pull(&$lines): void
    {
        $this->value = array_shift($lines);
    }

    public function __toString(): string
    {
        return __CLASS__ . ' : ' . self::SYMBOL . $this->length . ' - ' . $this->getValue();
    }

    public static function getSymbol(): string
    {
        return self::SYMBOL;
    }
}
