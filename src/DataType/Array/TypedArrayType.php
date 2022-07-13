<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable\DataType\Array;

class TypedArrayType extends ArrayType
{
    public const SYMBOL = '@';

    public static function getSymbol(): string
    {
        return self::SYMBOL;
    }
}
