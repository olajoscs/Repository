<?php

namespace OlajosCs\Repository\Factories;

use OlajosCs\QueryBuilder\MySQL\Connection;


/**
 * Class ConnectionFactory
 *
 *
 */
class ConnectionFactory
{
    /**
     *
     *
     * @return Connection
     */
    public static function get()
    {
        static $connection = null;

        if ($connection === null) {
            $config = include(__DIR__ . '../../../config/config.php');

            $dsn = "{$config['type']}:host={$config['host']};dbname={$config['database']};";
            $connection = new Connection($dsn, $config['user'], $config['password'], $config['options']);
        }

        return $connection;
    }
}