<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable;

use RuntimeException;
use Skytable\Exception\ServerException;
use Socket\Raw\Factory;
use Socket\Raw\Socket;

class Connection
{
    protected Socket $socket;

    /**
     * @throws ServerException
     */
    public function __construct($host, $port = 2003, $callback = null)
    {
        try {
            $this->socket = (new Factory())->createClient($host . ':' . $port);
        } catch (\Exception $e) {
            throw new ServerException("socket_create() failed: reason: " . $e->getMessage());
        }

        if ($callback) {
            $callback($this);
        }
    }

    /**
     * @param ActionsBuilder $builder
     * @return Response array of Response
     * @throws ServerException
     */
    public function execute(ActionsBuilder $builder): Response
    {
        try {
            $input = $builder->payload();
            $this->socket->write($input);
        } catch (\Exception $e) {
            throw new RuntimeException("socket_write() failed.\nReason: " . $e->getMessage() . "\n");
        }

        try {
            $out = $this->socket->recv(2048, MSG_EOF);
        } catch (\Exception $e) {
            throw new ServerException("receive data failed; reason: " . $e->getMessage() . "\n");
        }

        return new Response($out);
    }

    public function __destruct()
    {
        $this->socket->close();
    }
}
