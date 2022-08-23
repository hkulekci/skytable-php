<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable;

use Skytable\DataType\ActionType;
use Skytable\DataType\Array\AnyArrayType;
use Skytable\DataType\Array\ArrayType;
use Skytable\DataType\CodeType;
use Skytable\DataType\DefaultType;
use Skytable\DataType\Array\FlatArrayType;
use Skytable\DataType\Primitive\BinaryStringType;
use Skytable\DataType\Primitive\FloatType;
use Skytable\DataType\Primitive\IntType;
use Skytable\DataType\Primitive\StringType;
use Skytable\DataType\Array\TypedNonNullArrayType;
use Skytable\DataType\Array\TypedArrayType;
use Skytable\DataType\TypeInterface;

class Response
{
    protected string $content;

    protected array $parsedBody;

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
        $this->parsedBody = $this->parse();
    }

    public function getLastData(): TypeInterface
    {
        return end($this->parsedBody);
    }

    private function parse(): array
    {
        $responses = [];
        $lines = explode("\n", $this->content);
        while ($line = array_shift($lines)) {
            $tSymbol = strlpop($line); // remove type symbol
            /** @var TypeInterface $typedData */
            $typedData = match ($tSymbol) {
                ActionType::SYMBOL => new ActionType($line),
                CodeType::SYMBOL => new CodeType($line),
                IntType::SYMBOL => new IntType($line),
                FloatType::SYMBOL => new FloatType($line),
                StringType::SYMBOL => new StringType($line),
                BinaryStringType::SYMBOL => new BinaryStringType($line),
                TypedNonNullArrayType::SYMBOL => new TypedNonNullArrayType($line),
                TypedArrayType::SYMBOL => new TypedArrayType($line),
                FlatArrayType::SYMBOL => new FlatArrayType($line),
                AnyArrayType::SYMBOL => new AnyArrayType($line),
                ArrayType::SYMBOL => new ArrayType($line),
                default => new DefaultType($line),
            };

            $typedData->pull($lines);

            $responses[] = $typedData;
        }

        return $responses;
    }
}
