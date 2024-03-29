<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable\DataType;


class ActionType implements TypeInterface
{
    public const SYMBOL = '*';
    private string $length;

    public function __construct(string $meta)
    {
        $this->length = $meta;
    }

    public function getLength(): int
    {
        return 0;
    }

    public function getValue(): mixed
    {
        return null;
    }

    public function pull(&$lines): void
    {
    }

    public function __toString(): string
    {
        return __CLASS__ . ' : ' . self::SYMBOL . $this->length . ' - ' . $this->getValue();
    }
}
