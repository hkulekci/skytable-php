<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable;

/**
 * @Client is the client class of Skytable.
 *
 * @link \Skytable\Action\Dbsize
 * @method dbsize()
 *
 * @link \Skytable\Action\Del
 * @method del(string $key)
 *
 * @link \Skytable\Action\Exists
 * @method exists(array $keys)
 *
 * @link \Skytable\Action\Flushdb
 * @method flushdb()
 *
 * @link \Skytable\Action\Get
 * @method get(string $key)
 *
 * @link \Skytable\Action\Heya
 * @method heya()
 *
 * @link \Skytable\Action\Lget
 * @method lget(string $key)
 *
 * @link \Skytable\Action\Lset
 * @method lset(string $key, array $values)
 *
 * @link \Skytable\Action\Mget
 * @method mget(array $keys)
 *
 * @link \Skytable\Action\Mpop
 * @method mpop(array $keys)
 *
 * @link \Skytable\Action\Pop
 * @method pop(string $key)
 *
 * @link \Skytable\Action\Select
 * @method select(string $name)
 *
 * @link \Skytable\Action\Set
 * @method set(string $key, $value)
 *
 * @link \Skytable\Action\Update
 * @method update(string $key, $value)
 *
 * @link \Skytable\Action\Whereami
 * @method whereami()
 *
 * @link \Skytable\Action\Auth\Claim
 * @method auth_claim(string $originKey)
 *
 * @link \Skytable\Action\Auth\Claim
 * @method auth_login(string $username, string $token)
 *
 * @link \Skytable\Action\Create\Keyspace
 * @method create_keyspace(string $name)
 *
 * @link \Skytable\Action\Create\Table
 * @method create_table(string $name)
 *
 * @link \Skytable\Action\Drop\Keyspace
 * @method drop_keyspace(string $name)
 *
 * @link \Skytable\Action\Lmod\Pop
 * @method lmod_pop(string $key)
 *
 * @link \Skytable\Action\Lmod\Push
 * @method lmod_push(string $key, string $value)
 *
 * @link \Skytable\Action\Lmod\Rpop
 * @method lmod_rpop(string $key)
 *
 * @link \Skytable\Action\Sys\Info\Protocol
 * @method sys_info_protocol()
 *
 * @link \Skytable\Action\Sys\Info\Protover
 * @method sys_info_protover()
 *
 * @link \Skytable\Action\Sys\Info\Version
 * @method sys_info_version()
 */
class Client
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function execute(ActionsBuilder $payload): array
    {
        return $this->connection->execute($payload);
    }

    public function __call($name, $arguments)
    {
        $actionBuilder = new ActionsBuilder();
        $className = str_replace(' ', '\\', ucwords(str_replace('_', ' ', $name)));
        $classNameWithNamespace = __NAMESPACE__ . '\\Action\\' . $className;
        if (class_exists($classNameWithNamespace)) {
            $actionBuilder->add(new $classNameWithNamespace(...$arguments));
        } else {
            throw new \RuntimeException("Action $className not found");
        }
        $responses = $this->connection->execute($actionBuilder);

        if (count($responses) === 1) {
            return $responses[0];
        }

        return $responses;
    }
}
