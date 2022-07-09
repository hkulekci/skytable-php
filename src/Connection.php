<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable;

class Connection
{
    protected $socket;

    public function __construct($host, $port = 2003)
    {
        $address = gethostbyname($host);
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($this->socket === false) {
            throw new \RuntimeException("socket_create() failed: reason: " . socket_strerror(socket_last_error()));
        }

        $result = socket_connect($this->socket, $address, $port);
        if ($result === false) {
            throw new \RuntimeException("socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($this->socket)) . "\n");
        }
    }

    public function write(string $payload): array
    {
        $result = socket_write($this->socket, $payload, strlen($payload));
        if ($result === false) {
            throw new \RuntimeException("socket_write() failed.\nReason: ($result) " . socket_strerror(socket_last_error($this->socket)) . "\n");
        }

        $bytes = socket_recv($this->socket, $out, 2048, MSG_EOF);
        if (false !== $bytes) {
            return (new ResponseParser($out))->parse();
        }

        throw new \RuntimeException("socket_recv() failed; reason: " . socket_strerror(socket_last_error($this->socket)) . "\n");
    }

    public function __destruct()
    {
        if ($this->socket) {
            socket_close($this->socket);
        }
    }
}