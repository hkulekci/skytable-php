<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable\DataType\Array;

class FlatArrayType extends ArrayType
{
    public const SYMBOL = '_';

    public static function getSymbol(): string
    {
        return self::SYMBOL;
    }
}