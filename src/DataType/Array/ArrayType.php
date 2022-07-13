<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable\DataType\Array;

use Skytable\DataType\DefaultType;
use Skytable\DataType\Primitive\BinaryStringType;
use Skytable\DataType\Primitive\FloatType;
use Skytable\DataType\Primitive\IntType;
use Skytable\DataType\Primitive\StringType;
use Skytable\DataType\TypeInterface;

class ArrayType implements TypeInterface
{
    public const SYMBOL = '&';

    private int $length;
    private array $value;
    private string $typeSymbol;

    public function __construct(string $meta)
    {
        $this->typeSymbol = strlpop($meta, 1); // remove type symbol
        $this->length = (int) $meta;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function pull(&$lines): void
    {
        for ($i = 0; $i < $this->getLength(); $i++) {
            $line = array_shift($lines);
            $typedData = match ($this->typeSymbol) {
                IntType::SYMBOL => new IntType($line),
                FloatType::SYMBOL => new FloatType($line),
                StringType::SYMBOL => new StringType($line),
                BinaryStringType::SYMBOL => new BinaryStringType($line),
                default => new DefaultType($line),
            };

            $typedData->pull($lines);
            $this->value[] = $typedData;
        }
    }

    public static function getSymbol(): string
    {
        return self::SYMBOL;
    }

    public function getValue(): array
    {
        return $this->value;
    }
}
