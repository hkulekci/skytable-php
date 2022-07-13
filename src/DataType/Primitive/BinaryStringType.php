<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable\DataType\Primitive;

use Skytable\DataType\TypeInterface;

class BinaryStringType implements TypeInterface
{
    public const SYMBOL = '?';

    private string $length;
    private string $value;

    public function __construct(string $meta)
    {
        $this->length = (int) $meta;
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
}
