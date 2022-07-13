<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable\DataType;

use Skytable\DataType\Primitive\StringType;

class DefaultType extends StringType
{
    public static function getSymbol(): string
    {
        return self::SYMBOL;
    }
}
