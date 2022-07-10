<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Response;


class Response implements ResponseInterface
{
    protected array $response;

    /**
     * @param array $response
     *
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
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function getLength(): int
    {
        return substr($this->response[0], 1);
    }

    public function getContent()
    {
        return $this->response[1];
    }

    public function __toString(): string
    {
        return get_class($this) . ' : ' . $this->getLength() . ' - ' . $this->getContent();
    }
}
