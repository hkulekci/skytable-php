<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable\DataType;

class CodeType implements TypeInterface
{
    public const SYMBOL = '!';

    /**
     * @var string
     * 0	Okay	The server succeded in carrying out some operation
     * 1	Nil	The client asked for a non-existent object
     * 2	Overwrite Error	The client tried to overwrite data
     * 3	Action Error	The action didn't expect the arguments sent
     * 4	Packet Error	The packet contains invalid data
     * 5	Server Error	An error occurred on the server side
     * 6	Other error	Some other error response
     * 7	Wrong type error	The client sent the wrong type
     * 8	Unknown data type	The client sent an unknown data type
     * 9	Encoding error	The client sent a badly encoded query
     * 10	Bad credentials	The authn credentials are invalid
     * 11	Authn realm error	The current user is not allowed to perform the action
     * Error String	Other error with description	Some other error occurred. See this document
     */
    private string $value;
    private string $length;

    public function __construct(string $meta)
    {
        $this->length = $meta;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function pull(&$lines): void
    {
        $this->value = array_shift($lines);
    }

    public function __toString(): string
    {
        return __CLASS__ . ' : ' . self::SYMBOL . $this->length . ' - ' . $this->getValue();
    }
}
