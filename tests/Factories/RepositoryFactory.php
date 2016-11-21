<?php

namespace OlajosCs\Repository\Factories;

use OlajosCs\Repository\Sample\SampleRepository;


/**
 * Class RepositoryFactory
 *
 *
 */
class RepositoryFactory
{
    /**
     *
     *
     * @return null|SampleRepository
     */
    public static function get()
    {
        static $instance = null;

        if ($instance === null) {
            $instance = new SampleRepository(ConnectionFactory::get());
        }

        return $instance;
    }
}