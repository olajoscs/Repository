<?php

namespace OlajosCs\Repository\Contracts;


/**
 * Class ModelInterface
 *
 *
 */
interface ModelInterface extends \JsonSerializable
{
    /**
     * Return the name of the table in the database, which stores the model
     *
     * @return string
     */
    public static function getTableName();


    /**
     * Return the name of the id field of the model if exists
     *
     * @return string
     */
    public static function getIdField();
}