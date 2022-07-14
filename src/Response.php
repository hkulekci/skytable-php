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

    public function getParsedBody(): array
    {
        return $this->parsedBody;
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
                ActionType::getSymbol() => new ActionType($line),
                CodeType::getSymbol() => new CodeType($line),
                IntType::getSymbol() => new IntType($line),
                FloatType::getSymbol() => new FloatType($line),
                StringType::getSymbol() => new StringType($line),
                BinaryStringType::getSymbol() => new BinaryStringType($line),
                TypedNonNullArrayType::getSymbol() => new TypedNonNullArrayType($line),
                TypedArrayType::getSymbol() => new TypedArrayType($line),
                FlatArrayType::getSymbol() => new FlatArrayType($line),
                AnyArrayType::getSymbol() => new AnyArrayType($line),
                ArrayType::getSymbol() => new ArrayType($line),
                default => new DefaultType($line),
            };

            $typedData->pull($lines);

            $responses[] = $typedData;
        }

        return $responses;
    }
}
