<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable;

use RuntimeException;
use Skytable\Exception\ServerException;

class Connection
{
    protected $socket;

    /**
     * @throws ServerException
     */
    public function __construct($host, $port = 2003, $callback = null)
    {
        $address = gethostbyname($host);
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($this->socket === false) {
            throw new ServerException("socket_create() failed: reason: " . socket_strerror(socket_last_error()));
        }

        try {
            socket_connect($this->socket, $address, $port);
        } catch (\Exception $e) {
            throw new ServerException("socket_connect() failed: reason: " . $e->getMessage());
        }

        if ($callback) {
            $callback($this);
        }
    }

    /**
     * @param ActionsBuilder $builder
     * @return Response array of Response
     */
    public function execute(ActionsBuilder $builder): Response
    {
        $input = $builder->payload();
        $result = socket_write($this->socket, $input, strlen($input));
        if ($result === false) {
            throw new RuntimeException("socket_write() failed.\nReason: " . socket_strerror(socket_last_error($this->socket)) . "\n");
        }

        $bytes = socket_recv($this->socket, $out, 2048, MSG_EOF);

        if (false === $bytes) {
            throw new RuntimeException("socket_recv() failed; reason: " . socket_strerror(socket_last_error($this->socket)) . "\n");
        }

        return new Response($out);
    }

    public function __destruct()
    {
        if ($this->socket) {
            socket_close($this->socket);
        }
    }
}
