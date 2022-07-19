<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable;

use RuntimeException;

/**
 * @Client is the client class of Skytable.
 *
 * @link \Skytable\Action\Dbsize
 * @method dbsize(): TypeInterface
 *
 * @link \Skytable\Action\Del
 * @method del(string $key): TypeInterface
 *
 * @link \Skytable\Action\Exists
 * @method exists(array $keys): TypeInterface
 *
 * @link \Skytable\Action\Flushdb
 * @method flushdb(): TypeInterface
 *
 * @link \Skytable\Action\Get
 * @method get(string $key): TypeInterface
 *
 * @link \Skytable\Action\Heya
 * @method heya(): TypeInterface
 *
 * @link \Skytable\Action\Lget
 * @method lget(string $key): TypeInterface
 *
 * @link \Skytable\Action\Lget\First
 * @method lget_first(string $key): TypeInterface
 *
 * @link \Skytable\Action\Lget\Last
 * @method lget_last(string $key): TypeInterface
 *
 * @link \Skytable\Action\Lget\Len
 * @method lget_len(string $key): TypeInterface
 *
 * @link \Skytable\Action\Lget\Limit
 * @method lget_limit(string $key, int $limit = null): TypeInterface
 *
 * @link \Skytable\Action\Lget\Range
 * @method lget_range(string $key, int $start, int $stop = null): TypeInterface
 *
 * @link \Skytable\Action\Lget\Valueat
 * @method lget_valueat(string $key, int $index): TypeInterface
 *
 * @link \Skytable\Action\Lset
 * @method lset(string $key, array $values): TypeInterface
 *
 * @link \Skytable\Action\Mget
 * @method mget(array $keys): TypeInterface
 *
 * @link \Skytable\Action\Mpop
 * @method mpop(array $keys): TypeInterface
 *
 * @link \Skytable\Action\Pop
 * @method pop(string $key): TypeInterface
 *
 * @link \Skytable\Action\Select
 * @method select(string $name): TypeInterface
 *
 * @link \Skytable\Action\Set
 * @method set(string $key, $value): TypeInterface
 *
 * @link \Skytable\Action\Update
 * @method update(string $key, $value): TypeInterface
 *
 * @link \Skytable\Action\Whereami
 * @method whereami(): TypeInterface
 *
 * @link \Skytable\Action\Auth\Claim
 * @method auth_claim(string $originKey): TypeInterface
 *
 * @link \Skytable\Action\Auth\Claim
 * @method auth_login(string $username, string $token): TypeInterface
 *
 * @link \Skytable\Action\Create\Keyspace
 * @method create_keyspace(string $name): TypeInterface
 *
 * @link \Skytable\Action\Create\Table
 * @method create_table(string $name, string $keymap): TypeInterface
 *
 * @link \Skytable\Action\Drop\Keyspace
 * @method drop_keyspace(string $name): TypeInterface
 *
 * @link \Skytable\Action\Lmod\Pop
 * @method lmod_pop(string $key): TypeInterface
 *
 * @link \Skytable\Action\Lmod\Clear
 * @method lmod_clear(string $key): TypeInterface
 *
 * @link \Skytable\Action\Lmod\Push
 * @method lmod_push(string $key, string $value): TypeInterface
 *
 * @link \Skytable\Action\Lmod\Rpop
 * @method lmod_rpop(string $key): TypeInterface
 *
 * @link \Skytable\Action\Sys\Info\Protocol
 * @method sys_info_protocol(): TypeInterface
 *
 * @link \Skytable\Action\Sys\Info\Protover
 * @method sys_info_protover(): TypeInterface
 *
 * @link \Skytable\Action\Sys\Info\Version
 * @method sys_info_version(): TypeInterface
 *
 * @link \Skytable\Action\Sys\Metric\Health
 * @method sys_metric_health(): TypeInterface
 *
 * @link \Skytable\Action\Sys\Metric\Storage
 * @method sys_metric_storage(): TypeInterface
 *
 * @link \Skytable\Action\Inspect\Keyspaces
 * @method inspect_keyspaces(): TypeInterface
 *
 * @link \Skytable\Action\Inspect\Keyspace
 * @method inspect_keyspace(string $entity = null): TypeInterface
 *
 * @link \Skytable\Action\Inspect\Table
 * @method inspect_table(string $entity = null): TypeInterface
 */
class Client
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function execute(ActionsBuilder $payload): Response
    {
        return $this->connection->execute($payload);
    }

    public function __call($name, $arguments)
    {
        $actionBuilder = new ActionsBuilder();
        $className = str_replace(' ', '\\', ucwords(str_replace('_', ' ', $name)));
        $classNameWithNamespace = __NAMESPACE__ . '\\Action\\' . $className;

        if (!class_exists($classNameWithNamespace)) {
            throw new RuntimeException("Action $className not found");
        }

        $actionBuilder->add(new $classNameWithNamespace(...$arguments));

        return $this->connection->execute($actionBuilder)->getLastData();
    }
}
