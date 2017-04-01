<?php

/**
 * Config for the connection for the test
 */
return [
    'host'     => 'localhost',
    'database' => 'sample_database',
    'username' => 'travis',
    'password' => '',
    'charset'  => 'utf8',
    'options'  => [
        PDO::ATTR_PERSISTENT         => true,
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ]
];