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

            $connection = new Connection($config['host'], $config['username'], $config['password'], $config['database'], $config['options']);
        }

        return $connection;
    }
}