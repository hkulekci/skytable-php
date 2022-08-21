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

    public function getSocket(): Socket
    {
        return $this->socket;
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
            $this->getSocket()->write($input);
        } catch (\Exception $e) {
            throw new ServerException("writing data failed. reason: " . $e->getMessage());
        }

        try {
            $out = $this->getSocket()->recv(2048, MSG_EOF);
        } catch (\Exception $e) {
            throw new ServerException("receiving data failed. reason: " . $e->getMessage());
        }

        return new Response($out);
    }

    public function __destruct()
    {
        $this->getSocket()->close();
    }
}
