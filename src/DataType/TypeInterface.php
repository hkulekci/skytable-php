<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\DataType;

interface TypeInterface
{
    public const SYMBOL = null;

    /**
     * Length of the data type
     *
     * @return int
     */
    public function getLength(): int;

    /**
     * The value of the data
     *
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * Pull data from the response stream according to the data type internal logic
     * @param array &$lines
     * @return void
     */
    public function pull(&$lines): void;
}
