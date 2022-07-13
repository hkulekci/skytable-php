# Skytable PHP Client

Skytable is an insanely fast, free and open-source, realtime NoSQL database that aims to provide flexible data 
modeling without compromising on performance or queryability — at scale.

This library is a client for PHP that allows you to interact with the Skytable server. It is very simple to use. 

Here an example to create a connection for Skytable:

```php
<?php
include __DIR__ . '/../vendor/autoload.php';

$connection = new \Skytable\Connection('127.0.0.1', 2003);
```

## Skytable Client with Connection

Client requires a Connection to be created. Client have methods to send command to the client.

```php
<?php
include __DIR__ . '/../vendor/autoload.php';

$connection = new \Skytable\Connection('127.0.0.1', 2003);
$client = new \Skytable\Client($connection);
```

## Running Basic Commands

After creating a connection, you can use the client to run basic commands.

```php
<?php

$response = $client->heya();
$response = $client->whereami();
```

You can find the list of commands inside the Client class docblock. 

## Running Multiple Commands

To run multiple command, you need to use ActionBuilder. Every command have their own class. You need to initialize 
the command and add it to the ActionBuilder as payload.

```php
<?php
$builder = new ActionsBuilder();
$builder->add((new \Skytable\Action\Sys\Metric\Storage()));
$builder->add((new \Skytable\Action\Sys\Metric\Health()));

$response = $client->execute($builder);
```


## Initial commands after connection
While creating a connection, you can also specify a callback to run first commands after connected : 

```php
$connection = new Connection('127.0.0.1', 2003, static function($connection) {
    $payload = new ActionsBuilder();
    $payload->add(new \Skytable\Action\Create\Table('queue', 'keymap(str, list<str>)'));
    $payload->add(new \Skytable\Action\Select('default:queue'));
});
```

## Managing a Queue

To be able to create a queue, you need to create a table with the `keymap` model.

```php
<?php

$skytable->create_table('queue', 'keymap(str,list<str>)');
$skytable->select('default:queue');

$skytable->lmod_push('queue', '1');
$skytable->lmod_push('queue', '2');
$skytable->lmod_push('queue', '3');
$skytable->lmod_push('queue', '4');

var_dump($skytable->lmod_pop('queue'));
var_dump($skytable->lmod_rpop('queue'));
var_dump($skytable->lget('queue'));
```
