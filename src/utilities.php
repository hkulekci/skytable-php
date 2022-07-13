<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

function strlpop(&$str): string
{
    $firstChar = substr($str, 0, 1);
    $str = substr($str, 1);
    return $firstChar;
}
